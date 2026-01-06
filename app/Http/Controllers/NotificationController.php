<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    /**
     * Get recent notifications
     */
    public function index(): JsonResponse
    {
        $notifications = NotificationService::getRecent(20);
        $unreadCount = NotificationService::getUnreadCount();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Get unread count for badge
     */
    public function unreadCount(): JsonResponse
    {
        return response()->json([
            'count' => NotificationService::getUnreadCount(),
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(): JsonResponse
    {
        $updated = NotificationService::markAllAsRead();

        return response()->json([
            'success' => true,
            'updated' => $updated,
        ]);
    }
}
