<template>
    <div>
        <ul>
            <div class='div' v-bind:class="[isActive ? 'activated' : 'nonactivated']"
                @click="toggleClass(), selectedTab = 'Аналитика'">Аналитика</div>
            <div class='div' v-bind:class="[isActive ? 'nonactivated' : 'activated']"
                @click="isActive = !isActive, selectedTab = 'Карта'">Карта</div>
        </ul>
        <div class="contentClass" v-show="selectedTab === 'Аналитика'">
            <iframe src="https://navigator.almatybusiness.gov.kz/ru/analytics/business-requirements/" width="100%"
                height="1000" scrolling="no"></iframe>
        </div>
        <div class="contentClass" v-show="selectedTab === 'Карта'">
            <iframe src="https://navigator.almatybusiness.gov.kz/ru/analytics/business-requirements-map/" width="100%"
                height="1000" scrolling="no"></iframe>
        </div>
    </div>


</template>

<script>
export default {
    name: "ConsultationNeeds",
    data() {
        return {
            isActive: true,
            tabs: ['Аналитика', 'Карта'],
            selectedTab: 'Аналитика'  // устанавливается с помощью @click
        }
    },
    methods: {
        toggleClass: function (event) {
            this.isActive = !this.isActive;
        }
    }

}
</script>

<style scoped>
.nonactivated {
    border: 1px solid gray;
    background-color: white;
    color: #1C84FF;
}

.activated {
    border: 1px solid #1C84FF;
    background-color: #1C84FF;
    color: white;
}

.div {
    width: 120px;
    height: 40px;
    display: inline-block;
    border-radius: 20px;
    padding-top: 7px;
    margin-right: 20px;
    text-align: center;
}

.contentClass {
    margin-top: 10px;
}
</style>
