<template>
    <div>
        <v-text-field
            v-model="entity[fieldName]"
            :type="type"
            :label="$vuetify.lang.t(`$vuetify.page.${entityName}.${fieldName}`)"
            :rules="rules"
        >
            <span
                slot="prepend">
                {{$langs.default}}
            </span>
        </v-text-field>
        <v-text-field
            v-for="lang in $langs.translationList" :key="`lang_${lang}_${fieldName}`"
            v-model="translation(lang)[fieldName]"
            :type="type"
            :label="$vuetify.lang.t(`$vuetify.page.${entityName}.${fieldName}`)"
            :rules="rules"
        >
            <span
                slot="prepend">
                {{lang}}
            </span>
        </v-text-field>
    </div>
</template>

<script>
export default {
    name: "RLInputMultiLang",
    props: {
        entityName: String,
        fieldName: String,
        entity: Object,
        type: {
            type: String,
            default: 'text'
        },
        rules: {
            type: Array,
            default: function () {
                return []
            }
        }
    },
    created() {
        this.checkTranslationStructure()
    },
    computed: {
        hasMaxLength(){
            return this.type === 'text' && this.maxLength
        },

    },
    data() {
        return {
            vue: this,
        }
    },
    methods:{
        getIsoCountryByLang(lang){
            switch (lang){
                case 'ru':
                    return 'ru'
                    break
                case 'en':
                    return 'us'
                    break
                case 'kk':
                    return 'kz'
                    break
            }
        },
        checkTranslationStructure(){
            for(let lang of this.$langs.translationList){
                if (!this.entity.translations || this.entity.translations.length === 0) {
                    this.entity.translations = [{
                        language: lang,
                        content: {}
                    }]
                }

                let index = this.entity.translations.findIndex(item => item.language === lang)
                if(index === -1){
                    this.entity.translations.push({
                        language: lang,
                        content: {}
                    })
                    index = this.entity.translations.findIndex(item => item.language === lang)
                }
                if(!this.entity.translations[index].content[this.fieldName]){
                    this.entity.translations[index].content[this.fieldName] = null
                }
            }
        },
        translationIndex(lang) {
            if(!this.entity.translations){
                this.checkTranslationStructure()
            }
            let index = this.entity.translations.findIndex(item => item.language === lang)
            return index === -1 ? 0 : index
        },
        translation(lang) {
            if(!this.entity.translations){
                this.checkTranslationStructure()
            }
            return this.entity.translations[this.translationIndex(lang)].content
        },
    }
}
</script>

<style scoped>

</style>
