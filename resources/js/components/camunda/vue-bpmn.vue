<template>
    <div
        ref="container"
        class="vue-bpmn-diagram-container"
    ></div>
</template>

<script>
import BpmnJS from 'bpmn-js/dist/bpmn-navigated-viewer.production.min';
// import BpmnJS from 'bpmn-js/dist/bpmn-modeler.development';

export default {
    name: 'vue-bpmn',
    props: {
        url: {
            type: String
        },
        xmlData: {
            type: String
        },
        highlightElements: {
            type: Array
        },
        options: {
            type: Object
        }
    },
    data: function () {
        return {
            diagramXML: null
        };
    },
    mounted: function () {
        this.showDiagram()
    },
    beforeDestroy: function () {
        this.bpmnViewer.destroy();
    },
    watch: {
        url: function (val) {
            this.$emit('loading');
            this.fetchDiagram(val);
        },
        // diagramXML: function (val) {
        //     this.bpmnViewer.importXML(val);
        // }
        highlightElements(){
            let canvas = this.bpmnViewer.get('canvas')

            this.highlightElements.forEach(item => {
                canvas.addMarker(item, 'highlight');
            })
        }
    },
    methods: {
        async showDiagram() {
            let container = this.$refs.container;

            let self = this;
            let _options = Object.assign({
                container: container
            }, this.options)
            this.bpmnViewer = new BpmnJS(_options);

            this.bpmnViewer.on('import.done', function (event) {

                let error = event.error;
                let warnings = event.warnings;

                if (error) {
                    self.$emit('error', error);
                } else {
                    self.$emit('shown', warnings);
                }

                self.bpmnViewer.get('canvas').zoom('fit-viewport');
            });

            if (this.url) {
                await this.bpmnViewer.importXML(this.fetchDiagram(this.url));
            } else if(this.xmlData){
                await this.bpmnViewer.importXML(this.xmlData);
            }

            if(this.highlightElements){
                let canvas = this.bpmnViewer.get('canvas')

                this.highlightElements.forEach(item => {
                    canvas.addMarker(item, 'highlight');
                })
            }
        },
        async fetchDiagram(url) {

            let self = this;

            await fetch(url)
                .then(function (response) {
                    return response.text();
                })
                .catch(function (err) {
                    self.$emit('error', err);
                });
        }
    }
};
</script>

<style>
.vue-bpmn-diagram-container {
    height: 100%;
    width: 100%;
}
</style>
