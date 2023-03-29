<template>
  <div class="report-container">
    <div id="viewer"></div>
  </div>
</template>

<script>
Stimulsoft.Base.StiLicense.key = "6vJhGtLLLz2GNviWmUTrhSqnOItdDwjBylQzQcAOiHmiINMogLqZu5Jqwjx7YOytYXNLW5rBBuT+cHL5+N6MZtlGj7"
    + "Y9edSXJ2Xz+AQkITDeXSB/xAtFLgJFwms2Q5clJieY92lzMf75SWR8d54ILz1cVaf1u/a1KyYrwFvn18M6qUmndFhe"
    + "trfcy8FPjBjVJTiFPEYVf1T7Tejd612JOVmvH5kekFll0WcF2xDSMT0p2P0/hZe+rIHYx8rQ5SLmYXhwWaYNl9/JwX"
    + "JOvb0HSarNZiu7gsk8Zuiri+3+krA3VsHxi64Is6e6m5wLLt848RmrwtMJTTgOnwM2Eh6UzZ6WjqQtQVWwjyJy/Iax"
    + "zYlFHLfZJTo53OPA2BQrjLBUYVErA+7dE7SYc5eb6+cSIylgo76cgpxH4/jE9UfOqErT973cG+yTcIOSFMteiRYMDl"
    + "t2ncnoO5AGD8guApuzTLe5dc0RlE1muT/MgzMDDgPYxWHPpd5liVHwErFPHGp4w43FsaAtvmGqWFE2jTEPNKaRADLG"
    + "kLmD0SbRmP07WUMDIVA6j2vaILury6SPPY4CsFMQyFd0p+Htu3RklLBmLA==";

const viewer = new window.Stimulsoft.Viewer.StiViewer(null, 'StiViewer', false);
window.Stimulsoft.Base.Localization.StiLocalization.setLocalizationFile('/reports/locale/ru.xml');
// report.localizeReport('kk-KZ');


export default {
  name: "ReportViewerComponent",
  props: {
    reportFile: String,
    data: [Object, Array],
    dataSource: String,
  },
  mounted(){
    const report = new window.Stimulsoft.Report.StiReport();
    const dataSet = new Stimulsoft.System.Data.DataSet();
    report.loadFile(this.reportFile);
    viewer.report = report;
    report.dictionary.databases.clear();
    dataSet.readJson(this.data);
    report.regData(this.dataSource,this.dataSource, dataSet);
    viewer.renderHtml('viewer');
  },
  watch: {
    data(){
      const report = new window.Stimulsoft.Report.StiReport();
      report.loadFile(this.reportFile);
      viewer.report = report;
      const dataSet = new Stimulsoft.System.Data.DataSet();
      dataSet.readJson(this.data);
      report.dictionary.databases.clear();
      report.regData(this.dataSource,this.dataSource, dataSet);
      viewer.report = report;
      viewer.refreshViewer()
    }
  }
}
</script>

<style scoped>

</style>
