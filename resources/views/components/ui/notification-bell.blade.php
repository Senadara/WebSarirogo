{{-- 
    Notification Bell Component
    Usage: @include('components.ui.notification-bell')
    
    This component shows a bell icon with badge counter.
    When clicked, it opens a dropdown with recent notifications
    and marks all as read.
--}}

<div 
    x-data="notificationBell()" 
    x-init="fetchUnreadCount()"
    class="relative"
>
    {{-- Bell Button --}}
    <button 
        @click="toggleDropdown()"
        class="relative p-2 rounded-full hover:bg-gray-100 transition"
    >
        <img src="/assets/icons/notification.svg" class="w-5 h-5" alt="notifikasi">
        
        {{-- Badge Counter --}}
        <span 
            x-show="unreadCount > 0" 
            x-text="unreadCount > 99 ? '99+' : unreadCount"
            x-transition
            class="absolute -top-1 -right-1 min-w-[18px] h-[18px] flex items-center justify-center text-[10px] font-bold text-white bg-red-500 rounded-full px-1"
        ></span>
    </button>

    {{-- Dropdown Panel --}}
    <div 
        x-show="isOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.away="isOpen = false"
        class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden"
    >
        {{-- Header --}}
        <div class="px-4 py-3 bg-gray-50 border-b flex items-center justify-between">
            <h3 class="font-semibold text-gray-800">Notifikasi</h3>
            <span x-show="unreadCount > 0" class="text-xs text-primary-4" x-text="unreadCount + ' belum dibaca'"></span>
        </div>

        {{-- Notification List --}}
        <div class="max-h-80 overflow-y-auto">
            <template x-if="notifications.length === 0">
                <div class="px-4 py-8 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-sm">Belum ada notifikasi</p>
                </div>
            </template>

            <template x-for="notification in notifications" :key="notification.id">
                <div 
                    class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition cursor-pointer"
                    :class="{ 'bg-blue-50': !notification.is_read }"
                >
                    <div class="flex items-start gap-3">
                        {{-- Type Badge --}}
                        <span 
                            class="px-2 py-0.5 text-[10px] font-medium rounded-full shrink-0 mt-0.5"
                            :class="{
                                'bg-green-100 text-green-800': notification.notification_type === 'create',
                                'bg-blue-100 text-blue-800': notification.notification_type === 'update',
                                'bg-red-100 text-red-800': notification.notification_type === 'delete'
                            }"
                            x-text="notification.notification_type === 'create' ? 'Baru' : (notification.notification_type === 'update' ? 'Edit' : 'Hapus')"
                        ></span>
                        
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 truncate" x-text="notification.title"></p>
                            <p class="text-xs text-gray-500 truncate" x-text="notification.message"></p>
                            <p class="text-[10px] text-gray-400 mt-1" x-text="formatTime(notification.created_at)"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-2 bg-gray-50 border-t text-center">
            <a href="{{ route('admin.activities.index') }}" class="text-xs text-primary-4 hover:text-primary-5 font-medium">
                Lihat semua aktivitas
            </a>
        </div>
    </div>
</div>

<script>
function notificationBell() {
    return {
        isOpen: false,
        unreadCount: 0,
        notifications: [],
        
        async fetchUnreadCount() {
            try {
                const response = await fetch('/api/notifications/unread-count');
                const data = await response.json();
                this.unreadCount = data.count;
            } catch (e) {
                console.error('Failed to fetch unread count:', e);
            }
        },
        
        async toggleDropdown() {
            this.isOpen = !this.isOpen;
            
            if (this.isOpen) {
                // Fetch notifications when opening
                try {
                    const response = await fetch('/api/notifications');
                    const data = await response.json();
                    this.notifications = data.notifications;
                    this.unreadCount = data.unread_count;
                    
                    // Mark all as read
                    if (this.unreadCount > 0) {
                        await fetch('/api/notifications/mark-read', { method: 'POST' });
                        this.unreadCount = 0;
                    }
                } catch (e) {
                    console.error('Failed to fetch notifications:', e);
                }
            }
        },
        
        formatTime(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diff = Math.floor((now - date) / 1000);
            
            if (diff < 60) return 'Baru saja';
            if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
            if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
            if (diff < 604800) return Math.floor(diff / 86400) + ' hari lalu';
            
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        }
    }
}
</script>
