<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    /**
     * Create a notification for all users (except the one who performed the action)
     *
     * @param string $type - create, update, delete
     * @param string $entityType - Model class name (Cage, User, etc)
     * @param int $entityId - ID of the entity
     * @param string $title - Notification title
     * @param string $message - Notification message
     */
    public static function create(
        string $type,
        string $entityType,
        int $entityId,
        string $title,
        string $message
    ): Notification {
        return Notification::create([
            'user_id' => Auth::id(),
            'notification_type' => $type,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }

    /**
     * Helper untuk create notification
     */
    public static function notifyCreate(string $entityType, int $entityId, string $entityName): Notification
    {
        $userName = Auth::user()->name ?? 'User';
        return self::create(
            'create',
            $entityType,
            $entityId,
            "Data {$entityType} Baru",
            "{$userName} menambahkan {$entityType}: {$entityName}"
        );
    }

    /**
     * Helper untuk update notification
     */
    public static function notifyUpdate(string $entityType, int $entityId, string $entityName): Notification
    {
        $userName = Auth::user()->name ?? 'User';
        return self::create(
            'update',
            $entityType,
            $entityId,
            "Data {$entityType} Diubah",
            "{$userName} mengubah {$entityType}: {$entityName}"
        );
    }

    /**
     * Helper untuk delete notification
     */
    public static function notifyDelete(string $entityType, int $entityId, string $entityName): Notification
    {
        $userName = Auth::user()->name ?? 'User';
        return self::create(
            'delete',
            $entityType,
            $entityId,
            "Data {$entityType} Dihapus",
            "{$userName} menghapus {$entityType}: {$entityName}"
        );
    }

    /**
     * Get unread count for badge
     */
    public static function getUnreadCount(): int
    {
        return Notification::unread()->count();
    }

    /**
     * Mark all notifications as read
     */
    public static function markAllAsRead(): int
    {
        return Notification::unread()->update(['is_read' => true]);
    }

    /**
     * Get recent notifications
     */
    public static function getRecent(int $limit = 10)
    {
        return Notification::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
