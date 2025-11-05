<!-- resources/views/notifications-modal.blade.php -->
<div class="fixed inset-0 z-[100] hidden" id="notificationsModal">
    <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-blur-sm" id="modalBackdrop"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-2xl h-full max-h-[85vh] transform transition-all duration-300 ease-out">
            <div class="flex flex-col bg-white shadow-2xl rounded-3xl overflow-hidden h-full">
                <!-- Modal Header -->
                <div class="glassmorphism-header border-b border-gray-100 p-4 sm:p-6 flex-shrink-0">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 truncate">Notifications</h2>
                            <p class="text-gray-600 text-sm sm:text-base mt-1">Stay updated with your wardrobe activities</p>
                        </div>
                        <div class="flex items-center space-x-2 sm:space-x-3 ml-4">
                            <button class="text-gray-600 hover:text-primary transition p-2 sm:p-0" id="markAllReadModal" title="Mark all as read">
                                <i class="fas fa-check-double text-sm sm:text-base"></i>
                                <span class="hidden sm:inline ml-1">Mark all</span>
                            </button>
                            <button class="text-gray-600 hover:text-primary transition p-2 sm:p-0" id="closeNotificationsModal">
                                <i class="fas fa-times text-lg sm:text-xl"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Filter Tabs -->
                    <div class="mt-4 flex flex-wrap gap-2">
                        <button class="filter-tab active bg-primary text-white rounded-lg sm:rounded-xl px-3 py-2 text-xs sm:text-sm font-medium transition-all hover:bg-purple-700 flex-1 sm:flex-none min-w-[60px]" data-filter="all">
                            All
                        </button>
                        <button class="filter-tab bg-gray-100 text-gray-700 rounded-lg sm:rounded-xl px-3 py-2 text-xs sm:text-sm font-medium transition-all hover:bg-gray-200 flex-1 sm:flex-none min-w-[60px]" data-filter="unread">
                            Unread
                        </button>
                        <button class="filter-tab bg-gray-100 text-gray-700 rounded-lg sm:rounded-xl px-3 py-2 text-xs sm:text-sm font-medium transition-all hover:bg-gray-200 flex-1 sm:flex-none min-w-[60px]" data-filter="system">
                            System
                        </button>
                        <button class="filter-tab bg-gray-100 text-gray-700 rounded-lg sm:rounded-xl px-3 py-2 text-xs sm:text-sm font-medium transition-all hover:bg-gray-200 flex-1 sm:flex-none min-w-[60px]" data-filter="recommendations">
                            Recommendations
                        </button>
                    </div>
                </div>

                <!-- Notifications Content - Scrollable Area -->
                <div class="flex-1 overflow-hidden bg-white">
                    <div class="h-full overflow-y-auto" id="modalNotificationsContent">
                        <div class="p-4 sm:p-6">
                            <!-- Static Notifications Content -->
                            <div class="space-y-3 sm:space-y-4" id="modalNotificationsList">
                                <!-- Unread Notification -->
                                <div class="notification-card-modal unread glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-primary bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal primary mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-tshirt text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    New Outfit Recommendation
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">Just now</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                Our AI has created a new outfit combination based on your recent preferences. Check out this stylish combination featuring your favorite items.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-primary bg-opacity-10 text-primary rounded-full px-2 py-1 text-xs">AI Generated</span>
                                                    <span class="bg-secondary bg-opacity-10 text-secondary rounded-full px-2 py-1 text-xs">Personalized</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    View Outfit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Notification -->
                                <div class="notification-card-modal info glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-secondary bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal info mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-info-circle text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    Laundry Reminder
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">2 hours ago</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                Your "Blue Denim Jacket" is due for washing. It's been 2 weeks since it was last cleaned. Regular maintenance helps preserve your clothing quality.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-secondary bg-opacity-10 text-secondary rounded-full px-2 py-1 text-xs">Maintenance</span>
                                                    <span class="bg-gray-100 text-gray-600 rounded-full px-2 py-1 text-xs">Due Now</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    Snooze
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Warning Notification -->
                                <div class="notification-card-modal warning glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-yellow-500 bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal warning mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    Weather Alert
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">5 hours ago</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                The outfit you planned for tomorrow might not be suitable due to expected rain. Consider a waterproof alternative or indoor activities.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-yellow-100 text-yellow-800 rounded-full px-2 py-1 text-xs">Weather Alert</span>
                                                    <span class="bg-primary bg-opacity-10 text-primary rounded-full px-2 py-1 text-xs">Planned Outfit</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    Adjust Plan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Success Notification -->
                                <div class="notification-card-modal success glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-success bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal success mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-check-circle text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    Order Shipped
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">1 day ago</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                Your order #STYLE-4892 has been shipped and is on its way. Expected delivery: Oct 28, 2023. Track your package for real-time updates.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-success bg-opacity-10 text-success rounded-full px-2 py-1 text-xs">Shipping</span>
                                                    <span class="bg-gray-100 text-gray-600 rounded-full px-2 py-1 text-xs">On Time</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    Track Order
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Read Notification -->
                                <div class="notification-card-modal glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-gray-300 bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal primary mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-calendar-check text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    Outfit Worn Successfully
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">3 days ago</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                You've successfully logged your "Business Meeting" outfit. It's been added to your style history and will help improve future recommendations.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-primary bg-opacity-10 text-primary rounded-full px-2 py-1 text-xs">Activity</span>
                                                    <span class="bg-gray-100 text-gray-600 rounded-full px-2 py-1 text-xs">Completed</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    View History
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add more notifications to test scrolling -->
                                <div class="notification-card-modal glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-primary bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal info mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-sync-alt text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    Style Profile Updated
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">4 days ago</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                Your style preferences have been updated based on your recent outfit choices and ratings.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-primary bg-opacity-10 text-primary rounded-full px-2 py-1 text-xs">Profile</span>
                                                <span class="bg-secondary bg-opacity-10 text-secondary rounded-full px-2 py-1 text-xs">Updated</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    View Profile
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="notification-card-modal glassmorphism-card rounded-xl sm:rounded-2xl border-l-4 border-success bg-white p-3 sm:p-4 shadow-sm transition-all duration-300 hover:shadow-md">
                                    <div class="flex items-start">
                                        <div class="notification-icon-modal success mr-3 sm:mr-4 flex-shrink-0">
                                            <i class="fas fa-star text-sm sm:text-base"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2">
                                                <h3 class="font-bold text-gray-900 text-sm sm:text-base truncate">
                                                    Weekly Style Report
                                                </h3>
                                                <span class="text-xs text-gray-500 mt-1 sm:mt-0 sm:ml-4 whitespace-nowrap">1 week ago</span>
                                            </div>
                                            <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">
                                                Your weekly style report is ready! Check out your most worn items and discover new outfit combinations.
                                            </p>
                                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                                <div class="flex flex-wrap gap-1 sm:gap-2">
                                                    <span class="bg-success bg-opacity-10 text-success rounded-full px-2 py-1 text-xs">Report</span>
                                                    <span class="bg-primary bg-opacity-10 text-primary rounded-full px-2 py-1 text-xs">Weekly</span>
                                                </div>
                                                <button class="text-primary hover:text-purple-700 text-xs sm:text-sm font-medium transition whitespace-nowrap">
                                                    View Report
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Empty State (Hidden by default) -->
                            <div class="empty-state-modal hidden text-center py-8 sm:py-12" id="modalEmptyState">
                                <div class="inline-flex h-12 w-12 sm:h-16 sm:w-16 items-center justify-center rounded-full bg-gray-100">
                                    <i class="fas fa-bell-slash text-lg sm:text-xl text-gray-400"></i>
                                </div>
                                <h3 class="mt-3 sm:mt-4 text-lg sm:text-xl font-bold text-gray-900">No notifications</h3>
                                <p class="mt-1 sm:mt-2 text-gray-600 text-sm sm:text-base max-w-xs mx-auto">
                                    You're all caught up! When you have new notifications, they'll appear here.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glassmorphism-header {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .glassmorphism-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .notification-icon-modal {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    @media (min-width: 640px) {
        .notification-icon-modal {
            width: 44px;
            height: 44px;
            border-radius: 12px;
        }
    }

    .notification-icon-modal.primary {
        background: rgba(159, 122, 234, 0.1);
        color: #9f7aea;
        border: 1px solid rgba(159, 122, 234, 0.2);
    }

    .notification-icon-modal.info {
        background: rgba(79, 209, 197, 0.1);
        color: #4fd1c5;
        border: 1px solid rgba(79, 209, 197, 0.2);
    }

    .notification-icon-modal.warning {
        background: rgba(246, 173, 85, 0.1);
        color: #f6ad55;
        border: 1px solid rgba(246, 173, 85, 0.2);
    }

    .notification-icon-modal.success {
        background: rgba(104, 211, 145, 0.1);
        color: #68d391;
        border: 1px solid rgba(104, 211, 145, 0.2);
    }

    .notification-card-modal.unread {
        background: rgba(159, 122, 234, 0.03);
    }

    /* Line clamp utility for text truncation */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom scrollbar for modal */
    #modalNotificationsContent {
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.2) rgba(0, 0, 0, 0.05);
    }

    #modalNotificationsContent::-webkit-scrollbar {
        width: 6px;
    }

    #modalNotificationsContent::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05);
        border-radius: 3px;
    }

    #modalNotificationsContent::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    #modalNotificationsContent::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.3);
    }

    /* Smooth animations for modal */
    #notificationsModal {
        transition: opacity 0.3s ease;
    }

    #notificationsModal > div:last-child > div {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    #notificationsModal:not(.hidden) > div:last-child > div {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Ensure proper flex behavior for scrolling */
    .flex-1 {
        flex: 1 1 0%;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    .overflow-y-auto {
        overflow-y: auto;
    }
</style>

<script>
    // Notifications Modal Functionality
    const notificationsModal = document.getElementById('notificationsModal');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const closeNotificationsModal = document.getElementById('closeNotificationsModal');
    const markAllReadModal = document.getElementById('markAllReadModal');
    const filterTabs = document.querySelectorAll('.filter-tab');

    // Open notifications modal when bell icon is clicked (using event delegation)
    document.addEventListener('click', function(e) {
        if (e.target.closest('#bellIcon')) {
            e.preventDefault();
            notificationsModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    });

    // Close notifications modal
    function closeNotificationsModalHandler() {
        notificationsModal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Mark all as read
    function markAllAsRead() {
        const unreadNotifications = document.querySelectorAll('.notification-card-modal.unread');
        unreadNotifications.forEach(notification => {
            notification.classList.remove('unread');
        });
        
        // Show temporary feedback
        const originalText = markAllReadModal.innerHTML;
        markAllReadModal.innerHTML = '<i class="fas fa-check mr-1"></i><span class="hidden sm:inline">Marked all</span>';
        setTimeout(() => {
            markAllReadModal.innerHTML = originalText;
        }, 2000);
    }

    // Filter notifications
    function filterNotifications(filter) {
        const notifications = document.querySelectorAll('.notification-card-modal');
        let visibleCount = 0;

        notifications.forEach(notification => {
            let showNotification = false;

            switch (filter) {
                case 'all':
                    showNotification = true;
                    break;
                case 'unread':
                    showNotification = notification.classList.contains('unread');
                    break;
                case 'system':
                    showNotification = notification.querySelector('.notification-icon-modal.info') || 
                                      notification.querySelector('.notification-icon-modal.warning');
                    break;
                case 'recommendations':
                    showNotification = notification.textContent.includes('Recommendation') || 
                                      notification.textContent.includes('Outfit');
                    break;
            }

            if (showNotification) {
                notification.style.display = 'flex';
                visibleCount++;
            } else {
                notification.style.display = 'none';
            }
        });

        // Show/hide empty state
        const emptyState = document.getElementById('modalEmptyState');
        const notificationsList = document.getElementById('modalNotificationsList');
        
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
            notificationsList.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            notificationsList.classList.remove('hidden');
        }
    }

    // Event listeners
    closeNotificationsModal.addEventListener('click', closeNotificationsModalHandler);
    modalBackdrop.addEventListener('click', closeNotificationsModalHandler);
    markAllReadModal.addEventListener('click', markAllAsRead);

    // Filter tabs
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            filterTabs.forEach(t => t.classList.remove('active', 'bg-primary', 'text-white', 'hover:bg-purple-700'));
            this.classList.add('active', 'bg-primary', 'text-white', 'hover:bg-purple-700');
            this.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
            filterNotifications(this.dataset.filter);
        });
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !notificationsModal.classList.contains('hidden')) {
            closeNotificationsModalHandler();
        }
    });

    // Mark as read when clicking on notifications
    document.addEventListener('click', function(e) {
        if (e.target.closest('.notification-card-modal')) {
            const notification = e.target.closest('.notification-card-modal');
            if (!e.target.closest('button') && notification.classList.contains('unread')) {
                notification.classList.remove('unread');
            }
        }
    });

    // Initialize filter on load
    document.addEventListener('DOMContentLoaded', function() {
        filterNotifications('all');
    });
</script>