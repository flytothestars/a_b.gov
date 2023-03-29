import Vue from "vue";

Vue.mixin({
    computed: {
        axiosLoading() {
            return this.$store.getters.loading
        },
        fieldValidationRules() {
            return {
                required(vue) {
                    return value => !!value || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.required') : '')
                },
                onlyString(vue) {
                    const pattern = /^[a-zA-Z]*$/
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.onlyString') : '')
                },
                onlyNumber(vue) {
                    const pattern = /^[0-9]*$/
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.onlyNumber') : '')
                },
                onlyFloatNumber(vue) {
                    const pattern = /^[+-]?\d+(\.\d+)?$/
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.onlyNumber') : '')
                },
                floatNumberOptional(vue) {
                    const pattern = /^[+-]?\d+(\.\d+)?$/
                    return value => {
                        if(value === null)
                        {
                            return true;
                        }
                        if(value === 0)
                        {
                            return true;
                        }
                        if(value === '')
                        {
                            return true;
                        }
                        return pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.onlyNumber') : '');
                    }
                },
                onlyStringAndNumber(vue) {
                    const pattern = /^[a-zA-Z0-9]*$/
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.onlyStringAndNumber') : '')
                },
                email(vue) {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.email') : '')
                },
                newPassword(vue) {
                    const pattern = /^(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.newPassword') : '')
                },
                // confirmPassword(vue, password) {
                //     return value => {
                //         return value === vue[password] || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.confirmPassword') : '')
                //     }
                // },
                phone(vue) {
                    const pattern = /^[+]?[(]?[0-9]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/im
                    return value => pattern.test(value) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.phone') : '')
                },
                minLength(vue, length) {
                    return value => (value && value.length >= length) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.minLength', length) : '')
                },
                maxLength(vue, length) {
                    return value => (value && value.length <= length) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.maxLength', length) : '')
                },
                minVal(vue, val) {
                    return value => (value && value * 1 >= val) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.minVal', val) : '')
                },
                maxVal(vue, val) {
                    return value => (value && value * 1 <= val) || (vue.$vuetify ? vue.$vuetify.lang.t('$vuetify.validation.maxVal', val) : '')
                },
            }
        },
    },
    methods: {
        errorMessage(fieldName) {
            return this.$store.getters.error
                ? (
                    // eslint-disable-next-line no-prototype-builtins
                    this.$store.getters.error.hasOwnProperty(fieldName)
                        ? this.$store.getters.error[fieldName]
                        : null
                )
                : null
        }
    }
})
