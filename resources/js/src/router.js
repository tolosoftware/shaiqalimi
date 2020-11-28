/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  Object Strucutre:
                    path => router path
                    name => router name
                    component(lazy loading) => component to load
                    meta : {
                      rule => which user can have access (ACL)
                      breadcrumb => Add breadcrumb to specific page
                      pageTitle => Display title besides breadcrumb
                    }
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import Vue from 'vue'
import Router from 'vue-router'
import auth from '@/auth/authService'

import firebase from 'firebase/app'
import 'firebase/auth'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: '/',
    scrollBehavior() {
        return { x: 0, y: 0 }
    },
    routes: [{
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '',
            component: () =>
                import ('./layouts/main/Main.vue'),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: '/',
                    redirect: '/dashboard'
                },
                {
                    path: '/dashboard',
                    name: 'dashboard',
                    component: () =>
                        import ('./views/DashboardAnalytics.vue'),
                    meta: {
                        breadcrumb: [{ title: 'صفحه عمومی', active: true }],
                        rule: 'editor'
                    }
                },

                {
                    path: 'notifications',
                    name: 'dashboard-notifications',
                    component: () =>
                        import ('./views/DashboardNotifications.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'اعلانات', url: '/notifications', active: true }
                            // { title: 'Import/Export', url: '/'},
                            // { title: 'Export Selected', active: true }
                        ],
                        rule: 'admin'
                    }
                },

                // =============================================================================
                // Application Routes
                // =============================================================================
                {
                    path: '/projects',
                    redirect: '/projects/list',
                    name: 'projects'
                },
                {
                    path: '/projects/list',
                    component: () =>
                        import ('./views/apps/projects/Project.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            {
                                title: 'پروژه ها و قراردادها',
                                url: '/projects/list',
                                active: true
                            }
                        ],
                        rule: 'editor',
                        parent: 'projects',
                        no_scroll: true
                    }
                },
                {
                    path: '/projects/add',
                    component: () =>
                        import ('./views/apps/projects/ProjectAdd.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'پروژه ها و قراردادها', url: '/projects/list' },
                            {
                                title: 'افزودن پروژه جدید و لست قرار دادها',
                                active: true
                            }
                            // { title: 'Export Selected', active: true }
                        ],
                        rule: 'editor',
                        // parent: 'projects',
                        no_scroll: true
                    }
                },
                {
                    path: '/projects/project/:id',
                    name: 'project-view',
                    component: () =>
                        import ('./views/apps/projects/ProjectView.vue'),
                    props: true,
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'پروژه ها و قراردادها',
                                url: '/projects/list'
                            },
                            {
                                dyTitle: true
                            }
                        ],
                        rule: 'editor',
                        parent: 'projects',
                        no_scroll: true
                    }
                },
                {
                    path: '/projects/project/:id/edit',
                    name: 'project-view',
                    component: () =>
                        import ('./views/apps/projects/ProjectEdit.vue'),
                    props: true,
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'پروژه ها و قراردادها',
                                url: '/projects/list'
                            },
                            {
                                dyTitle: true
                            }
                        ],
                        rule: 'editor',
                        parent: 'projects',
                        no_scroll: true
                    }
                },
                {
                    path: '/projects/proposal',
                    name: 'proposal',
                    component: () =>
                        import ('./views/apps/projects/proposals/Proposal.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'پروژه ها و قراردادها',
                                url: '/projects/list'
                            },
                            {
                                title: 'ثبت پیشنهاد جدید',
                                active: true
                            }
                        ],
                        rule: 'editor'
                    }
                },
                {
                    path: '/projects/advertisment',
                    name: 'advertisment',
                    component: () =>
                        import ('./views/apps/projects/advertisments/Advertisment.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'پروژه ها و قراردادها',
                                url: '/projects/list'
                            },
                            {
                                title: 'ثبت اعلان جدید',
                                active: true
                            }
                        ],

                        rule: 'editor'
                    }
                },

                {
                    path: 'sales',
                    name: 'sales',
                    component: () =>
                        import ('./views/apps/sales/Sale.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'فروشات',
                                active: true
                            }
                        ],

                        rule: 'editor'
                    }
                },

                {
                    path: '/transactions',
                    name: 'transactions',
                    component: () =>
                        import ('./views/apps/transactions/Transaction.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'معاملات',
                                active: true
                            }
                        ],
                        rule: 'editor'
                    }
                },

                {
                    path: '/transactions/:filter',
                    component: () =>
                        import ('./views/apps/transactions/Transaction.vue'),
                    meta: {
                        rule: 'editor',
                        parent: 'email',
                        no_scroll: true
                    }
                },
                {
                    path: '/accounts',
                    name: 'accounts',
                    component: () =>
                        import ('./views/apps/accounts/Account.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'حسابات',
                                active: true
                            }
                        ],
                        rule: 'editor'
                    }
                },

                {
                    path: '/expenses',
                    name: 'expenses',
                    component: () =>
                        import ('./views/apps/expenses/Expense.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'مخارج', active: true }
                        ],
                        pageTitle: 'مصرف',
                        rule: 'editor'
                    }
                },
                {
                    path: '/inventory',
                    name: 'inventory',
                    component: () =>
                        import ('./views/apps/inventory/Inventory.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'دخایر و تانک تیل',
                                active: true
                            }
                        ],
                        rule: 'editor'
                    }
                },
                {
                    path: '/inventory/fuel-station',
                    name: 'fuel-station',
                    component: () =>
                        import ('./views/apps/inventory/add/FuelStation.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'دخایر و تانک تیل',
                                url: '/inventory'
                            },
                            {
                                title: 'تانک تیل',
                                active: true
                            }
                        ],
                        rule: 'editor',
                        parent: 'inventory'
                    }
                },
                {
                    path: '/inventory/goods',
                    name: 'goods',
                    component: () =>
                        import ('./views/apps/inventory/Goods/Goods_list.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'دخایر و تانک تیل',
                                url: '/inventory'
                            },
                            {
                                title: 'اجناس و محصولات',
                                active: true
                            }
                        ],
                        rule: 'editor',
                        parent: 'inventory'
                    }
                },
                {
                    path: '/inventory/godams',
                    name: 'godams',
                    component: () =>
                        import ('./views/apps/inventory/Godams/Godams_lis.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'دخایر و تانک تیل',
                                url: '/inventory'
                            },
                            {
                                title: 'گدام ها',
                                active: true
                            }
                        ],
                        rule: 'editor',
                        parent: 'inventory'
                    }
                },
                {
                    path: '/procurment',
                    name: 'procurment',
                    component: () =>
                        import ('./views/apps/procurments/Procurment.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/archive',
                    name: 'archive',
                    component: () =>
                        import ('./views/apps/archives/Archive.vue'),
                    meta: {
                        breadcrumb: [{
                                title: 'Home',
                                url: '/'
                            },
                            {
                                title: 'آرشیف',
                                active: true
                            }
                            // { title: 'Export Selected', active: true }
                        ],
                        rule: 'editor'
                    }
                },
                {
                    path: '/reports',
                    name: 'report',
                    component: () =>
                        import ('./views/apps/reports/Report.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/settings',
                    name: 'setting',
                    component: () =>
                        import ('./views/apps/settings/Setting.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                // =============================================================================
                // User Routes
                // =============================================================================
                {
                    path: '/user/management',
                    name: 'user-management',
                    component: () =>
                        import ('./views/apps/user/Profile.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'مدیریت کاربر', active: true }
                        ],
                        rule: 'editor'
                    }
                },
                {
                    path: '/user/edit/:user_id',
                    name: 'user-profile-edit',
                    component: () =>
                        import('./views/apps/user/sub/UserEdit.vue'),
                    meta: {
                        breadcrumb: [
                            {title: 'Home',url: '/'},
                            {title: 'مدیریت کاربر',url: {name: 'user-management'}},
                            {title: 'ویرایش کاربر', active: true}
                        ],
                        rule: 'editor'
                    }
                }
            ]
        },
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '/login',
                    name: 'login',
                    component: () => import('@/views/pages/login/Login.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },

            ]
        },
        {
            path: '/logout',
            name: 'logout',
            redirect: '/login'
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ]
})

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = 'none'
    }
})

router.beforeEach((to, from, next) => {
    firebase.auth().onAuthStateChanged(() => {
        // get firebase current user
        const firebaseCurrentUser = firebase.auth().currentUser

        // if (
        //     to.path === "/pages/login" ||
        //     to.path === "/pages/forgot-password" ||
        //     to.path === "/pages/error-404" ||
        //     to.path === "/pages/error-500" ||
        //     to.path === "/pages/register" ||
        //     to.path === "/callback" ||
        //     to.path === "/pages/comingsoon" ||
        //     (auth.isAuthenticated() || firebaseCurrentUser)
        // ) {
        //     return next();
        // }

        // If auth required, check login. If login fails redirect to login page
        if (to.meta.authRequired) {
            if (!(auth.isAuthenticated() || firebaseCurrentUser)) {
                router.push({ path: '/pages/login', query: { to: to.path } })
            }
        }

        return next()
            // Specify the current path as the customState parameter, meaning it
            // will be returned to the application after auth
            // auth.login({ target: to.path });
    })
})

export default router