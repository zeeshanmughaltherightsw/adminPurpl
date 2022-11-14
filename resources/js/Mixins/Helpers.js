import { isInteger } from 'lodash';
import moment from 'moment';

export default {
    methods: {
        // // formate time
        formatDate(dateString) {
            return moment(dateString).format("Do MMM YYYY");
        },
        // // formate date & time
        formatDateTime(dateString) {
            return moment(dateString).format("Do MMM YYYY h:mm A");
        },
        formatCurrency(currency = 0){
            return parseInt(currency).toFixed(2)
        },
        // // formate date & time Unix
        // formatDateTimeUnix(dateString) {
        //     return moment.unix(dateString).format("Do MMM YYYY h:mm:ss A");
        // },

        // generic function to get images
        getImage(path, isSaved = true, type = 'avatar', isExternal = 0) {
            const baseUrl = window.location.protocol + "//" + window.location.host
            if (isExternal) {
                return path
            } else {
                return this.$page.props.ziggy.url + '/storage/' + path
            }
            
        },

        //to get placeholder urls
        placeHolderUrls(type) {
            var url = ''
            switch(type) {
                case 'department':
                case 'category':
                case 'product':
                case 'variant':
                case 'news':
                    url = '/images/placeholder.png'
                    break
                case 'avatar':
                    url = '/images/no_avatar.jpg'
                    break
                case 'banner':
                    url = '/images/cover.jpg'
                    break
                case 'logo':
                    url = '/images/placeholder.png'
                    break
                case 'thumbnail':
                    url = '/images/placeholder.png'
                    break
            }
            return url
        },

        // get role full name
        getRoleName(role) {
            const Name = role.replace('_', ' ');
            return Name.charAt(0).toUpperCase() + Name.slice(1);
        },

        // check user permissions
        checkUserPermissions(value) {
            const permissionsArray = this.$page.props.auth.user.permissions;
            // for single record
            if (typeof value == 'string') {
                return permissionsArray.includes(value);
            }

            // for array of permissions
            if (typeof value == 'object') {
                var result = false;
                value.forEach(element => {
                    let response = permissionsArray.includes(element);
                    if (response) {
                        return result = response;
                    }
                });
                return result;
            }
        },

        // conversion to boolean values
        booleanStatusValue(status) {
            var value = false;
            switch (status) {
                case 'active':
                    value = true
                    break;
                case '1':
                    value = true
                    break;
                default:
                    break;
            }
            return value
        },

        // conversion to required boolean values
        booleanRequiredValue(required) {
            var value = false;
            switch (required) {
                case 1:
                    value = true
                    break;

                default:
                    break;
            }
            return value
        },

        // get group name
        getGroupName(group) {
            return group ? group.replaceAll('_', ' ') : null;
        },
        // get side bar permissions
        sideBarPermissions (value) {
            var permission = false;
            let condition = localStorage.getItem("selectedModule");
            switch (condition) {
                case 'settings':
                    var permissionsList = [
                        'view_users_tab',
                        'view_drivers_tab',
                        'view_settings_tab',
                    ];
                    permission = permissionsList.includes(value);
                    break;
                case '1':
                    var permissionsList = [
                        'view_global_tags_tab',
                        'view_categories_tab',
                        'view_business_tab',
                        'view_products_tab',
                        'view_manufacturer_tab', // which will be use as brands
                        'view_orders_tab',
                        'view_categories_mapper_tab',
                        'view_standard_tag',
                        'view_tags_mapper_tab',
                        'view_industry_tag',
                        'view_global_tags',
                        'view_attributes'
                    ];
                    permission = permissionsList.includes(value);
                    break;
                default:
                    break;
            }
            return permission;
        },

        // get selected track
        getSelectedModuleValue() {
            return localStorage.getItem("selectedModule")
        },

        // get selected track
        getSelectedBusinessValue() {
            return localStorage.getItem("selectedBusiness")
        },
        setTypeFormat(value){
            return value.replaceAll("_"," ");
        },
        activeBusinessSideBarMenu (value) {
            let path = value.uri.split('/')
            let blockRoutes = ['colors', 'sizes', 'coupons', 'manufacturers'];
            if(path.indexOf('orders') > -1) {
                let blockOrders = ['orders']
                return !blockOrders.includes(path[6]);
            } else {
                return !blockRoutes.includes(path[3]);
            }
        },
        getStatusForTable(status){
            switch(status){
                case 'active':
                    return 'text-success'
                case 'inactive':
                    return 'text-danger'
                case 'baned':
                    return 'text-danger'
                default :
                    return 'text-warning'
            }
            
        },
        showTooltip(){
            // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            // tooltipTriggerList.map(function (tooltipTriggerEl) {
            //     return new bootstrap.Tooltip(tooltipTriggerEl)
            // })
        },

        hideTooltip() {
            // $('[data-bs-toggle="tooltip"]').tooltip("hide");
        },
    }
}