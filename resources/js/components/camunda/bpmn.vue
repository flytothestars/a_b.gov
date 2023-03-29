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
    name: "bpmn",
    components: {VueBpmn},
    props: {
        id: String
    },
    data() {
        return {
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
            const bpmn20Xml = request.bpmn20Xml
            this.xmlData = bpmn20Xml
        })
        this.$store.dispatch(actionType.getBpmnHistory, {
            id: this.id
        }).then((request) => {
            this.highlightElements = request
                .filter(item => (item.activityType === "userTask" && item.endTime !== "0001-01-01T00:00:00" && item.assignee !== null) || item.activityType !== "userTask")
                .map(item => {
                    return item.activityId
                })
            // this.xmlData = bpmn20Xml
        })
    },
    methods: {
        handleError: function (err) {
            console.error('failed to show diagram', err);
        },
        handleShown: function () {
            console.log('diagram shown');
        },
        handleLoading: function () {
            console.log('diagram loading');
        }
    }
}
</script>

<style scoped>

</style>
