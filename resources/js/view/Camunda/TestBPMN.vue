<template>
    <vue-bpmn
        v-if="xmlData"
        :xml-data="xmlData"
        :options="options"
        :highlightElements="highlightElements"
        v-on:error="handleError"
        v-on:shown="handleShown"
        v-on:loading="handleLoading"
    ></vue-bpmn>
</template>

<script>
import VueBpmn from "../../components/camunda/vue-bpmn";
import {actionType} from "../../store/camunda";
export default {
    name: "TestBPMN",
    components: {VueBpmn},
    data() {
        return {
            diagramUrl: 'https://cdn.staticaly.com/gh/bpmn-io/bpmn-js-examples/dfceecba/starter/diagram.bpmn',
            xmlData: null,
            highlightElements: null,
            options: {
                propertiesPanel: {},
                additionalModules: [],
                moddleExtensions: []
            }
        }
    },
    created() {
        this.$store.dispatch(actionType.getBpmnDiagramXml).then(request => {
            this.highlightElements = ['StartEvent_1', 'Activity_Auto_Assign_ToWork']
            this.xmlData = request.bpmn20Xml
        })
    },
    methods: {
        handleError: function(err) {
            console.error('failed to show diagram', err);
        },
        handleShown: function() {
            console.log('diagram shown');
        },
        handleLoading: function() {
            console.log('diagram loading');
        }
    }
}
</script>

<style scoped>

</style>
