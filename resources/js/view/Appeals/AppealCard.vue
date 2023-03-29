<template>
    <div class="ma-3">
        <v-card v-if="appeal">
            <v-card-actions>
                <v-btn text @click="$router.go(-1)">
                    <v-icon class="mr-2">mdi-arrow-left</v-icon>
                    Вернуться назад
                </v-btn>
            </v-card-actions>
            <v-card-text>
                <v-tabs v-model="tab" height="100%">
                    <v-tab>{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.general') }}</v-tab>
                    <!-- <v-tab>{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.photo') }}</v-tab>
                    <v-tab>{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.additional_info') }}</v-tab> -->
                    <v-tab v-if="appeal.in_camunda">{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.bpmn') }}</v-tab>
                </v-tabs>
                <v-tabs-items v-model="tab">
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-row>
                                            <v-col cols="12" md="6">
                                                <label-with-data
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.appealNumber')">
                                                    {{ appeal.appeal_no }}
                                                </label-with-data>
                                                <label-with-data
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.source')">
                                                    <template v-if="appeal.appeal_source_type">
                                                        {{ appeal.appeal_source_type && appeal.appeal_source_type.name
                                                        }}
                                                    </template>
                                                    <template v-else-if="appeal.business">
                                                        {{
                                                                $vuetify.lang.t(`$vuetify.page.business.source.${appeal.business.source}`)
                                                        }}
                                                    </template>
                                                    <template v-else>Портал</template>
                                                </label-with-data>
                                                <label-with-data
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.distributor')">
                                                    {{ profileFio(appeal.distributor) }}
                                                </label-with-data>

                                                <label-with-data v-if="checkRole()"
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.status')">
                                                    {{ appeal.client_appeal_status && appeal.client_appeal_status.name
                                                    }}
                                                </label-with-data>
                                                <label-with-data v-else
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.status')">
                                                    {{ appeal.appeal_status && appeal.appeal_status.name }}
                                                </label-with-data>
                                                <label-with-data v-if="appeal.content !== null && checkRole()"
                                                    label="Коментарии:">
                                                    {{ appeal.content }}
                                                </label-with-data>
                                                <label-with-data v-if="appeal.qolday_product_or_comment
                                                && appeal.qolday_product_or_comment.length
                                                && appeal.qolday_product_or_comment[0].category"
                                                    label="Продукт Qolday:">
                                                    {{ appeal.qolday_product_or_comment[0].category }}
                                                </label-with-data>
                                                <label-with-data v-if="appeal.qolday_product_or_comment
                                                && appeal.qolday_product_or_comment.length
                                                && appeal.qolday_product_or_comment[0].comment" label="Комментарий:">
                                                    {{ appeal.qolday_product_or_comment[0].comment }}
                                                </label-with-data>
                                                <label-with-data
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.category')">
                                                    {{ appeal.category && appeal.category.name }}
                                                </label-with-data>
                                                <label-with-data
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.district')">
                                                    <template v-if="appeal.district">
                                                        {{ appeal.district && appeal.district.name }}
                                                    </template>
                                                    <template v-else>
                                                        Не выбран
                                                    </template>
                                                </label-with-data>
                                                <label-with-data
                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.industry')">
                                                    <template v-if="appeal && appeal.client && appeal.client.industry">
                                                        {{ appeal.client && appeal.client.industry &&
                                                                appeal.client.industry.name
                                                        }}
                                                    </template>
                                                    <template v-else-if="businessActivityType">
                                                        {{ businessActivityType.name }}
                                                    </template>
                                                    <template v-else>
                                                        Не выбран
                                                    </template>
                                                </label-with-data>
                                            </v-col>
                                            <v-col col="12" md="6">
                                                <label-with-data>&nbsp</label-with-data>
                                                <template v-if="appeal.business">
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.company')">
                                                        {{ appeal.business && appeal.business.name }}
                                                    </label-with-data>
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.bin')">
                                                        <template v-if="appeal.business.organization">
                                                            {{ appeal.business && appeal.business.organization &&
                                                                    appeal.business.organization.iin
                                                            }}
                                                        </template>
                                                        <template v-else>
                                                            Нет
                                                        </template>
                                                    </label-with-data>
                                                </template>
                                                <template v-else>
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.client')">
                                                        {{ profileFio(appeal.client) }}
                                                    </label-with-data>
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.company')">
                                                        <template v-if="appeal.client">
                                                            {{ appeal.client && appeal.client.company_name }}
                                                        </template>
                                                    </label-with-data>
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.iin')">
                                                        <template v-if="appeal.client">
                                                            {{ appeal.client && appeal.client.iin }}
                                                        </template>
                                                    </label-with-data>
                                                </template>
                                                <!--                                                <label-with-data-->
                                                <!--                                                    :label="$vuetify.lang.t('$vuetify.page.appeal.content')">-->
                                                <!--                                                    {{ appeal.content }}-->
                                                <!--                                                </label-with-data>-->
                                                <template v-if="appeal.business">
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.contacts')">
                                                        <div v-for="contact in businessContacts" :key="contact.id">
                                                            +7{{ contact.phone_number }} - {{ contact.full_name }}<span
                                                                v-if="businessContacts[businessContacts.length - 1] !== contact">,</span>
                                                        </div>
                                                    </label-with-data>
                                                </template>
                                                <template v-else>
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.contacts')">
                                                        <template v-if="appeal.client">
                                                            <div>{{ appeal.client.user && appeal.client.user.phone }}
                                                            </div>
                                                            <div>{{ appeal.client.user && appeal.client.user.email }}
                                                            </div>
                                                        </template>
                                                    </label-with-data>
                                                </template>
                                                <template v-if="checkRole() && appeal.iefiles !== null">
                                                    <label-with-data
                                                        :label="$vuetify.lang.t('$vuetify.page.appeal.file')">
                                                        <!-- KZ version is not -->
                                                        <template
                                                            v-if="appeal.category.id === 'b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67'">
                                                            <ol>
                                                                <li><a :href="getUrl(appeal.iefiles.file1)"
                                                                        download>Заявки
                                                                        на
                                                                        размещение в МПП</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file2)"
                                                                        download>Справка о
                                                                        государственной регистрации</a>
                                                                </li>
                                                                <li><a :href="getUrl(appeal.iefiles.file3)"
                                                                        download>Справка об
                                                                        отсутствии налоговой задолженности</a></li>
                                                            </ol>

                                                        </template>
                                                        <template v-else>
                                                            <ol>
                                                                <li><a :href="getUrl(appeal.iefiles.file1)"
                                                                        download>Заявление</a>
                                                                </li>
                                                                <li><a :href="getUrl(appeal.iefiles.file2)"
                                                                        download>Справка о
                                                                        государственной регистрации (перерегистрации)
                                                                        юридического лица</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file3)"
                                                                        download>Копия
                                                                        документа, удостоверяющего личность первого
                                                                        руководителя заявителя</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file4)"
                                                                        download>Копия устава
                                                                        юридического лица</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file5)"
                                                                        download>Копия
                                                                        финансовой отчетности на последнюю отчетную
                                                                        дату, подписанная первым руководителем заявителя
                                                                        или лицом, его замещающим, а также главным
                                                                        бухгалтером (бухгалтером)</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file6)"
                                                                        download>Бухгалтерский
                                                                        баланс за полный 1 год</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file7)"
                                                                        download>Отчет о
                                                                        доходах и расходах</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file8)"
                                                                        download>Отчет о
                                                                        движении денежных средств</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file9)"
                                                                        download>Отчет об
                                                                        изменениях собственного капитала</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file10)">Пояснительная
                                                                        записка к отчету на год</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file11)"
                                                                        download>Технико-экономическое
                                                                        обоснование проекта, отвечающее требованиям,
                                                                        установленным уполномоченным органом</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file12)"
                                                                        download>Выписка
                                                                        обслуживающего банка о движении денег по
                                                                        банковским счетам заявителя и кредитный отчет из
                                                                        кредитного бюро</a></li>
                                                                <li><a :href="getUrl(appeal.iefiles.file13)"
                                                                        download>Справка
                                                                        органа государственных доходов по месту
                                                                        регистрационного учета о наличии или отсутствии
                                                                        задолженности по налогам и другим обязательным
                                                                        платежам в бюджет</a></li>
                                                            </ol>

                                                        </template>



                                                    </label-with-data>
                                                </template>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <label-with-data class="text-right"
                                            :label="$vuetify.lang.t('$vuetify.page.appeal.createDate')" :inline="true">
                                            {{ appeal.create_date | formatDateTime }}
                                        </label-with-data>
                                        <label-with-data class="text-right"
                                            :label="$vuetify.lang.t('$vuetify.page.appeal.updateDate')" :inline="true">
                                            <template v-if="appealHistory">
                                                {{ appealHistory[appealHistory.length - 1].created_at | formatDateTime2
                                                }}
                                            </template>
                                        </label-with-data>

                                        <template v-if="appeal.business">
                                            <div class="mb-3 text-right" v-if="lockCardActions">
                                                <v-chip color="red lighten-3" label small>
                                                    Необходимо обновление бизнеса
                                                </v-chip>
                                            </div>
                                            <!--                                            <div class="mb-3 text-right">-->
                                            <!--                                                <v-btn color="primary" small-->
                                            <!--                                                    :to="{ name: 'BusinessCard', params: { id: appeal.business.id } }">-->
                                            <!--                                                    Перейти в бизнесс-->
                                            <!--                                                </v-btn>-->
                                            <!--                                            </div>+77074441908-->
                                            <div class="mb-3 text-right">
                                                <div v-for="contact in businessContacts" :key="contact.id">
                                                    <v-btn @click="gotoWhatsapp(contact.phone_number)" color="#25D366"
                                                        small>
                                                        Whatsapp
                                                    </v-btn>
                                                </div>
                                            </div>
                                        </template>
                                    </v-col>
                                    <v-col v-if="!checkRole()" cols="12">
                                        <label-with-data :label="'Обращения бизнеса'">
                                            <template>
                                                <v-data-table class="mt-2" :headers="headers" :items="otherAppeals"
                                                    :footer-props="{
                                                        'items-per-page-options': [10, 20, 30]
                                                    }">
                                                    <template v-slot:item.name="{ item }">
                                                        {{ (item.business && item.business.name) || (item.client &&
                                                                item.client.fio)
                                                        }}
                                                    </template>
                                                    <template v-slot:item.actions="{ item }">
                                                        <v-btn small class="mr-2" @click="showCard(item)" outlined
                                                            color="primary">
                                                            Подробнее
                                                        </v-btn>
                                                    </template>
                                                </v-data-table>
                                            </template>
                                        </label-with-data>
                                    </v-col>
                                    <!-- sdas -->
                                    <v-col cols="12" v-if="!checkRole()">
                                        <appeal-history ref=" appealHistory" :appeal-id="id">
                                        </appeal-history>
                                    </v-col>

                                    <v-col cols="12"
                                        v-if="showAllActions/* && (!this.appeal.in_camunda && bpmnActions)*/">
                                        <template v-if="!checkRole()">
                                            <v-btn
                                                v-if="true/*canShowCantContact && existInBpmnActions('Activity_Cant_Contact')*/"
                                                :disabled="!canSetCantContact" @click="cantContact" small
                                                class="mr-2 mb-2">
                                                Не дозвон
                                            </v-btn>
                                            <!-- <v-btn
                                            v-if="canAssignCurator"
                                            @click="assignCuratorAppeal"
                                            small
                                            class="mr-2 mb-2"
                                        >
                                            Назначить в УПиИ
                                        </v-btn> -->
                                            <!-- <v-btn
                                            v-if="canReAssignDistributor"
                                            @click="reAssignDistributorAppeal"
                                            small
                                            class="mr-2 mb-2"
                                        >
                                            Переназначить консультанта
                                        </v-btn> -->
                                            <!-- <v-btn
                                            v-if="canAssignExecutor && existInBpmnActions('Activity_Assign_Qolday_Or_Upi')"
                                            @click="assignExecutorAppeal" small class="mr-2 mb-2">
                                            Назначить исполнителя
                                        </v-btn> -->
                                            <!-- <v-btn
                                            v-if="canAssignCoExecutor && existInBpmnActions('Activity_Assign_CoExecutor_1')"
                                            @click="assignCoExecutorAppeal" small class="mr-2 mb-2">
                                            Назначить соисполнителя
                                        </v-btn> -->
                                            <!-- <v-btn
                                            v-if="canReturnForRevision"
                                            @click="returnForRevisionAppeal"
                                            small
                                            class="mr-2 mb-2"
                                        >
                                            Возврат на доработку
                                        </v-btn> -->

                                            <v-btn :disabled="!isButtonAvailable" @click="consultationProvidedQolday"
                                                small class="mr-2 mb-2">
                                                Консультация оказана по продукту Qolday
                                            </v-btn>
                                            <v-btn :disabled="!isButtonAvailable" small class="mr-2 mb-2"
                                                @click="consultationProvidedNotQolday">
                                                Консультация оказана НЕ по продукту Qolday
                                            </v-btn>
                                            <v-btn :disabled="!isButtonAvailable" small class="mr-2 mb-2"
                                                @click="requiresClarification">
                                                Требует уточнения
                                            </v-btn>
                                            <v-btn :disabled="!isButtonAvailable" class="mr-2 mb-2"
                                                @click="editCategory" small>
                                                Изменить категорию
                                            </v-btn>

                                            <!-- <v-btn
                                            v-if="canComplete && existInBpmnActions('Activity_Completed_By_Distributor')"
                                            @click="completeAppeal" color="primary" small class="mr-2 mb-2">
                                            Исполнить
                                        </v-btn>
                                        <v-btn
                                            v-if="canConfirm && existInBpmnActions('Activity_Completed_By_Distributor')"
                                            @click="confirmAppeal" small class="mr-2 mb-2" color="primary">
                                            Исполнить
                                        </v-btn>
                                        <v-btn
                                            v-if="canDivisionDepartmentConfirm && existInBpmnActions('Activity_Completed_By_Distributor')"
                                            @click="divisionDepartmentConfirmAppeal" small class="mr-2 mb-2"
                                            color="primary">
                                            Исполнить
                                        </v-btn>

                                        <v-btn
                                            v-if="canReject && existInBpmnActions('Activity_Completed_By_Distributor')"
                                            @click="rejectAppeal" color="red" dark small class="mr-2 mb-2">
                                            Отказать
                                        </v-btn> -->
                                            <v-btn v-if="canCreateNewAppeal" color="primary" @click="createNewAppeal"
                                                small class="mr-2 mb-2">
                                                Создать новое обращение
                                            </v-btn>
                                            <v-btn v-if="!hasAccount" small color="primary" @click="openCreateAccount"
                                                class="mr-2 mb-2">
                                                Создать аккаунт
                                            </v-btn>
                                            <!-- <v-btn

                                            v-if="canSentToCorrection && existInBpmnActions('Activity_To_Correction')"
                                            small color="primary" @click="sentToCorrection" class="mr-2 mb-2">
                                            На корректировку
                                        </v-btn> -->
                                        </template>
                                        <template v-else>
                                            <v-btn :disabled="ieIsButtonAvailable" @click="ieConsultationAccess" small
                                                class="mr-2 mb-2">
                                                Одобрено
                                            </v-btn>
                                            <v-btn :disabled="ieIsButtonAvailable" @click="ieConsultationReject" small
                                                class="mr-2 mb-2">
                                                Отказано
                                            </v-btn>
                                        </template>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat class="mt-4">
                            <pseudo-photo-carousel v-if="appeal.client_documents || appeal.manager_documents"
                                :value="[...appeal.client_documents, ...appeal.manager_documents]">
                            </pseudo-photo-carousel>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card v-if="appeal.business" flat>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.business.signboard')">
                                            <template v-if="appeal.business.displayName">
                                                {{ appeal.business.displayName }}
                                            </template>
                                            <template else>
                                                Нет
                                            </template>
                                        </label-with-data>

                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.appeal.company')">
                                            {{ appeal.business.name }}
                                        </label-with-data>
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.business.AddressLine')">
                                            {{ appeal.business.address_line }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.AddressStringFromStat')">
                                            <span v-if="appeal.business">{{ appeal.business.district &&
                                                    appeal.business.district.name
                                            }}</span>
                                            <span v-else>-</span>
                                        </label-with-data>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.numberOfEmployees')">
                                            {{ appeal.business.employee_count }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.AvailabilityOfKKM')">
                                            {{ getAnswerFromValue(appeal.business.has_cash_register) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.NumberOfCashDesks')">
                                            {{ appeal.business.cash_register_count }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.POSTerminalAvailability')">
                                            {{ getAnswerFromValue(appeal.business.has_payment_terminal) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.NeedToContact')">
                                            {{ getAnswerFromValue(appeal.business.need_to_contact) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.RefusalToProvideIINBIN')">
                                            {{
                                                    getAnswerFromValue(appeal.business.refused_to_provide_identification_number)
                                            }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.IINNotFoundInBNS')">
                                            {{
                                                    getAnswerFromValue(appeal.business.identification_number_not_found_in_stat)
                                            }}
                                        </label-with-data>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item v-if="appeal.in_camunda">
                        <div style="height: 70vh">
                            <bpmn :id="appeal.id"></bpmn>
                        </div>
                    </v-tab-item>
                </v-tabs-items>
            </v-card-text>
        </v-card>
        <template v-if="appeal">
            <v-dialog v-model="dialog.byQolday">
                <v-card>
                    <v-card-title>
                        <span>Выберите продукт</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.byQolday = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-autocomplete v-model="actionData.byQoldayProduct" :items="appealCategoryList"
                                item-text="name" item-value="id" dense label="Продукт" return-object></v-autocomplete>
                        </v-form>
                    </v-card-text>
                    <v-card-title>
                        <span>Комментарий</span>
                        <v-spacer></v-spacer>
                        <!--                        <v-btn icon @click="dialog.notByQolday = false">-->
                        <!--                            <v-icon>mdi-close</v-icon>-->
                        <!--                        </v-btn>-->
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-textarea placeholder="Напишите комментарии" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction" :disabled="!actionData.byQoldayProduct">
                            Готово
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.ieAccess">
                <v-card>
                    <v-card-title>
                        <span>Одобрено</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.ieAccess = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-title>
                        <span>Комментарий</span>
                        <v-spacer></v-spacer>
                        <!--                        <v-btn icon @click="dialog.notByQolday = false">-->
                        <!--                            <v-icon>mdi-close</v-icon>-->
                        <!--                        </v-btn>-->
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-textarea placeholder="Напишите комментарии" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            Готово
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.ieReject">
                <v-card>
                    <v-card-title>
                        <span>Отказано</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.ieReject = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-title>
                        <span>Комментарий</span>
                        <v-spacer></v-spacer>
                        <!--                        <v-btn icon @click="dialog.notByQolday = false">-->
                        <!--                            <v-icon>mdi-close</v-icon>-->
                        <!--                        </v-btn>-->
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-textarea placeholder="Напишите комментарии" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            Готово
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.notByQolday">
                <v-card>
                    <v-card-title>
                        <span>Комментарий</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.notByQolday = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-textarea placeholder="Напишите комментарии" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction" :disabled="!actionData.comment">
                            Готово
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.clarification">
                <v-card>
                    <v-card-title>
                        <span>Комментарий</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.clarification = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-textarea placeholder="Напишите комментарии" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction" :disabled="!actionData.comment">
                            Готово
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.complete" width="500">
                <v-card>
                    <v-card-title>
                        <span>Исполнить</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.complete = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="completeActionform">
                            <v-autocomplete v-model="actionData.appealResultType" :items="appealResultTypeList"
                                item-text="name" item-value="id" dense label="Основание" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-file-input multiple v-model="actionData.files" label="Прикрепить документы" small-chips
                                :accept="formAcceptFiles" :error="isFieldFailed('files')"
                                :error-messages="getFieldFails('files')"></v-file-input>
                            <v-textarea placeholder="Напишите комментарии (необязательно)" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction"
                            :disabled="actionData.phone && (actionData.phone.length !== 12)">
                            Исполнить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.confirm" width="500">
                <v-card>
                    <v-card-title>
                        <span>Подтвердить</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.confirm = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="confirmActionform">
                            <v-textarea placeholder="Напишите комментарии (необязательно)" v-model="actionData.comment">
                            </v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            Подтвердить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.reject" width="500">
                <v-card>
                    <v-card-title>
                        <span>Отказать</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.reject = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="rejectActionform">
                            <v-autocomplete v-model="actionData.appealResultType" :items="appealResultTypeList"
                                item-text="name" item-value="id" dense label="Основание" return-object></v-autocomplete>
                            <v-file-input multiple v-model="actionData.files" label="Прикрепить документы" small-chips
                                :accept="formAcceptFiles" :error="isFieldFailed('files')"
                                :error-messages="getFieldFails('files')"></v-file-input>
                            <v-textarea placeholder="Напишите комментарии" v-model="actionData.comment"
                                :rules="[fieldValidationRules.required(vue)]"></v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="red darken-1" dark @click="applyAction">
                            Отказать
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.set_executor" width="500">
                <v-card>
                    <v-card-title>
                        <span v-if="!appeal.executor">Добавить исполнителя</span>
                        <span v-else>Переназначить исполнителя</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.set_executor = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="assignExecutorActionform">
                            <v-autocomplete prepend-inner-icon="mdi-account" v-model="actionData.executor"
                                :items="executorList" item-text="fio" item-value="id" dense label="Исполнитель"
                                return-object :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-autocomplete v-model="actionData.district" :items="districtList"
                                :readonly="districtReadOnly" item-text="name" item-value="id" dense label="Район"
                                return-object :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-autocomplete v-if="canChangeIndustry" v-model="actionData.industry" :items="industryList"
                                item-text="name" item-value="id" dense
                                :label="$vuetify.lang.t('$vuetify.page.appeal.industryAppeal')" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-textarea label="Комментарий" v-model="actionData.comment"></v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            <template v-if="!appeal.executor">
                                <v-icon class="mr-4">mdi-plus-circle</v-icon>
                                Добавить
                            </template>
                            <template v-else>
                                Переназначить
                            </template>
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.set_coExecutor" width="500">
                <v-card>
                    <v-card-title>
                        <span v-if="!appeal.co_executor">Добавить соисполнителя</span>
                        <span v-else>Переназначить соисполнителя</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.set_coExecutor = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="assignCoExecutorActionform">
                            <v-autocomplete prepend-inner-icon="mdi-account" v-model="actionData.coExecutor"
                                :items="coExecutorList" item-text="fio" item-value="id" dense label="Соисполнитель"
                                return-object></v-autocomplete>
                            <v-textarea label="Комментарий" v-model="actionData.comment"></v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            <v-icon class="mr-4">mdi-plus-circle</v-icon>
                            Добавить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.set_curator" width="500">
                <v-card>
                    <v-card-title>
                        <span>Добавить кураторов</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.set_curator = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="setCuratorActionform">
                            <v-autocomplete v-model="actionData.district" :items="districtList" item-text="name"
                                item-value="id" dense label="Район" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-autocomplete v-model="actionData.curatorUpi" :items="curatorUpiList" item-text="fio"
                                item-value="id" dense label="Куратор УПиИ" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-autocomplete v-if="canChangeIndustry" v-model="actionData.industry" :items="industryList"
                                item-text="name" item-value="id" dense
                                :label="$vuetify.lang.t('$vuetify.page.appeal.industryAppeal')" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-autocomplete v-model="actionData.curatorDistrict" :items="curatorDistrictListFiltered"
                                item-text="fio" item-value="id" dense label="Куратор районого акимата" return-object
                                auto-select-first :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                            <v-textarea label="Комментарий" v-model="actionData.comment"></v-textarea>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            <v-icon class="mr-4">mdi-plus-circle</v-icon>
                            Назначить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.reassign_distributor" width="500">
                <v-card>
                    <v-card-title>
                        <span>Переназначить консультанта</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.reassign_distributor = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="reassignDistributorForm">
                            <v-autocomplete v-model="actionData.distributor" :items="distributorList" item-text="fio"
                                item-value="id" dense label="Консультант" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction">
                            <v-icon class="mr-4">mdi-plus-circle</v-icon>
                            Переназначить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialog.edit_category" width="500">
                <v-card>
                    <v-card-title>
                        <span>Изменить категорию</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="dialog.edit_category = false">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="setCategoryActionform">
                            <v-autocomplete v-model="actionData.category" :items="appealChangeCategoryList"
                                item-text="name" item-value="id" dense label="Категория" return-object
                                :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="applyAction"
                            :disabled="!actionData.category || (appeal.category.id === actionData.category.id)">
                            <v-icon class="mr-4">mdi-pencil</v-icon>
                            Изменить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </template>
        <template v-if="appeal">
            <v-dialog v-model="dialog.create_account" @click:outside="closeDialog" width="500">
                <v-card>
                    <v-card-title>
                        <span>Создать аккаунт</span>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="closeDialog">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="accountActionform">
                            <v-text-field v-model="businessPhone" outlined dense
                                :label="$vuetify.lang.t('$vuetify.page.UserList.phone')"
                                :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 12), fieldValidationRules.phone(vue)]"
                                placeholder="+70000000000" :error="isFieldFailed('phone')"
                                :error-messages="getFieldFails('phone')"></v-text-field>
                            <!--                            <v-text-field-->
                            <!--                                v-model="actionData.password"-->
                            <!--                                outlined-->
                            <!--                                dense-->
                            <!--                                :label="$vuetify.lang.t('$vuetify.page.UserList.phone')"-->
                            <!--                                :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 12), fieldValidationRules.phone(vue)]"-->
                            <!--                                placeholder="Pa$$w0rd"-->
                            <!--                                :error="isFieldFailed('phone')"-->
                            <!--                                :error-messages="getFieldFails('phone')"-->
                            <!--                            ></v-text-field>-->
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="createAccount">
                            Создать аккаунт
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </template>
    </div>
</template>

<script>
import {
    actionType as dictionaryActionType,
    getterType as dictionaryGetterType
} from "../../store/dictionary/dictionary";
import {
    getterType as appealHistoryGetterType
} from "../../store/appeals";
import { acceptableFiles } from "../../support/files";

let actionEnum = {
    create: 0,
    edit: 1,
    set_executor: 2,
    set_coExecutor: 3,
    return_for_revision: 4,
    complete: 5,
    reject: 6,
    confirm: 7,
    set_curator: 8,
    division_department_confirm: 9,
    edit_category: 10,
    reassign_distributor: 11,
    cant_contact: 12,
    consultation_provided_qolday: 13,
    consultation_provided_not_qolday: 14,
    requires_clarification: 15,
    consultation_access: 16,
    consultation_reject: 17
}

import LabelWithData from "../../components/LabelWithData";
import AppealHistory from "../../components/AppealHistory";
import appealStatusEnum from "../../enums/appealStatusEnum";
import roleEnum from "../../enums/roleEnum";
import { getterType as distributorAppealsGetterType } from "../../store/appeals/distributorAppeals";
import { actionType as distributorAppealsActionType } from "../../store/appeals/distributorAppeals";
import { actionType as executorAppealsActionType } from "../../store/appeals/executorAppeals";
import { actionType as coExecutorAppealsActionType } from "../../store/appeals/coExecutorAppeals";
import { actionType as upiCuratorAppealsActionType } from "../../store/appeals/upiCuratorAppeals";
import { actionType as districtCuratorAppealsActionType } from "../../store/appeals/districtCuratorAppeals";
import { actionType as divisionCuratorAppealsActionType } from "../../store/appeals/divisionCuratorAppeals";
import { actionType as iemanagerAppealsActionType } from "../../store/appeals/iemanagerAppeals";
import { actionType as bpmnActionType } from "../../store/camunda";
import flowTypeEnum from "../../enums/flowTypeEnum";
import { actionType as businessActionType, getterType as businessGetterType } from "../../store/business";
import PseudoPhotoCarousel from "../../components/PseudoPhotoCarousel";
import appealActionTypeEnum from "../../enums/appealActionTypeEnum";
import appealResultTypeEnum from "../../enums/appealResultTypeEnum";
import {
    actionType as headAppealsActionType,
    getterType as headAppealsGetterType
} from "../../store/appeals/headAppeals";
import {
    actionType as upiHeadAppealsActionType,
} from "../../store/appeals/upiHeadAppeals";
import Bpmn from "../../components/camunda/bpmn";

export default {
    name: "AppealCard",
    components: { Bpmn, PseudoPhotoCarousel, LabelWithData, AppealHistory },
    props: {
        id: String
    },
    created() {
        let candidateGroup;
        switch (this.currentRole) {
            case roleEnum.Head: {
                this.actionStore = headAppealsActionType
                candidateGroup = 'Head'
                break
            }
            case roleEnum.IEManager: {
                this.actionStore = iemanagerAppealsActionType
                candidateGroup = 'IEManager'
                break
            }
            case roleEnum.Distributor: {
                this.actionStore = distributorAppealsActionType
                candidateGroup = 'Distributor'
                break
            }
            case roleEnum.Executor: {
                this.actionStore = executorAppealsActionType
                candidateGroup = 'Executor'
                break
            }
            case roleEnum.CoExecutor: {
                this.actionStore = coExecutorAppealsActionType
                candidateGroup = 'Distributor'
                break
            }
            case roleEnum.UpiCurator: {
                this.actionStore = upiCuratorAppealsActionType
                candidateGroup = 'CoExecutor'
                break
            }
            case roleEnum.DistrictCurator: {
                this.actionStore = districtCuratorAppealsActionType
                candidateGroup = 'DistrictCurator'
                break
            }
            case roleEnum.DivisionCurator: {
                this.actionStore = divisionCuratorAppealsActionType
                candidateGroup = 'DivisionCurator'
                break
            }
            case roleEnum.UpiHead: {
                this.actionStore = upiHeadAppealsActionType
                candidateGroup = 'UpiHead'
                break
            }
        }

        this.loadCard(candidateGroup)
        this.$store.dispatch(dictionaryActionType.retrieveDistrictDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveExecutorDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveExecutorUPIDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveUpiCuratorDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveDistrictCuratorDictionaryList)
        this.$store.dispatch(dictionaryActionType.appealCategoryDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveIndustryDictionaryList)
        if (this.currentRole === roleEnum.Head) {
            this.$store.dispatch(dictionaryActionType.retrieveDistributorDictionaryList)
        }
    },
    computed: {
        formAcceptFiles() {
            return acceptableFiles.join(', ');
        },
        businessPhotos() {
            return this.$store.getters[businessGetterType.getBusinessPhotos]
        },
        otherAppeals() {
            if (this.appeal?.business) {
                return this.appeal?.business?.appeals_list.map(c => ({ ...c, distributorName: `${c.distributor?.first_name} ${c.distributor?.last_name}` })).filter(c => c.id != this.appeal?.id)
            } else if (this.appeal?.client) {
                return this.appeal?.client?.appeals_list.map(c => ({ ...c, distributorName: `${c.distributor?.first_name} ${c.distributor?.last_name}` })).filter(c => c.id != this.appeal?.id)
            } else {
                return []
            }
        },
        businessContacts() {
            return this.$store.getters[businessGetterType.getBusinessContacts] //a
        },
        _appealStatusEnum() {
            return appealStatusEnum
        },
        _flowTypeEnum() {
            return flowTypeEnum
        },
        executorList() {
            switch (this.appeal.flow_type?.id) {
                case flowTypeEnum.Qoldau: {
                    return this.$store.getters[dictionaryGetterType.getExecutorDictionaryList]
                }
                case flowTypeEnum.Upi: {
                    return this.$store.getters[dictionaryGetterType.getExecutorUPIDictionaryList]
                }
                default: {
                    return this.$store.getters[dictionaryGetterType.getExecutorDictionaryList]
                }
            }
        },
        distributorList() {
            return this.$store.getters[dictionaryGetterType.getDistributorDictionaryList]
        },
        coExecutorList() {
            switch (this.appeal.flow_type?.id) {
                case flowTypeEnum.Qoldau: {
                    return this.$store.getters[dictionaryGetterType.getCoExecutorDictionaryList]
                }
                case flowTypeEnum.Upi: {
                    return this.$store.getters[dictionaryGetterType.getCoExecutorDictionaryList]
                }
                default: {
                    return this.$store.getters[dictionaryGetterType.getCoExecutorDictionaryList]
                }
            }
        },
        curatorUpiList() {
            return this.$store.getters[dictionaryGetterType.getUpiCuratorDictionaryList]
        },
        curatorDistrictList() {
            return this.$store.getters[dictionaryGetterType.getDistrictCuratorDictionaryList]
        },
        appealCategoryList() {
            return this.$store.getters[dictionaryGetterType.getAppealCategoryDictionaryList]
        },
        appealChangeCategoryList() {
            if (this.appeal.category?.id) {
                return this.appealCategoryList.filter((item) => item.id !== this.appeal.category?.id)
            }
            return this.appealCategoryList;
        },
        districtList() {
            return this.$store.getters[dictionaryGetterType.getDistrictDictionaryList]
        },
        industryList() {
            return this.$store.getters[dictionaryGetterType.getIndustryDictionaryList]
        },
        curatorDistrictListFiltered() {
            return this.curatorDistrictList.filter(item => item.department?.district?.id === this.actionData?.district?.id)
        },
        currentRole() {
            return this.$store.getters.userRoleList[0]
        },
        currentUser() {
            return this.$store.getters.user
        },
        districtReadOnly() {
            return this.appeal.flow_type?.id === flowTypeEnum.Upi
        },
        appealHistory() {
            return this.$store.getters[appealHistoryGetterType.getAppealHistory]
        },
        cantContactInHistory() {
            return this.appealHistory.filter(item => item.appeal_action_type.id === appealActionTypeEnum.CantContact)
        },
        isSetCanContactToday() {
            return this.cantContactInHistory.length > 0
                ? this.$moment(this.cantContactInHistory[this.cantContactInHistory.length - 1].created_at).isSame(new Date(), "day")
                : false
        },
        canSetCantContact() {
            return this.isButtonAvailable && this.appealHistory && this.cantContactInHistory.length < 3 && !this.isSetCanContactToday
        },
        canShowCantContact() {
            return ([roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id) || [roleEnum.Executor].includes(this.currentRole)
        },
        canAssignCurator() {
            return this.appeal.flow_type === null && [roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id
        },
        canReAssignDistributor() {
            return [roleEnum.Executor].includes(this.currentRole);
        },
        canAssignExecutor() {
            return (((this.appeal.flow_type === null || this.appeal.flow_type?.id === flowTypeEnum.Qoldau) && [roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id)
                || (this.appeal.flow_type?.id === flowTypeEnum.Upi && [roleEnum.UpiCurator].includes(this.currentRole) && this.appeal.upi_curator?.user.id === this.currentUser.id))
                && this.appeal.appeal_status.id !== appealStatusEnum.Confirmed
                && this.appeal.appeal_status.id !== appealStatusEnum.DivisionCuratorConfirm
        },
        canAssignCoExecutor() {
            return ([roleEnum.DistrictCurator].includes(this.currentRole)
                || ([roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id)
                || ([roleEnum.Executor].includes(this.currentRole) && this.appeal.flow_type?.id === flowTypeEnum.Qoldau)
            )
                && this.appeal.appeal_status.id !== appealStatusEnum.Confirmed
                && this.appeal.appeal_status.id !== appealStatusEnum.DivisionCuratorConfirm
        },
        canReturnForRevision() {
            return (
                ([roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id)
                || ([roleEnum.UpiCurator].includes(this.currentRole) && this.appeal.upi_curator?.user.id === this.currentUser.id)
                || ([roleEnum.DivisionCurator].includes(this.currentRole) && this.appeal.executor.department.id === this.currentUser.department.id)
            )
                && this.appeal.appeal_status.id === appealStatusEnum.Confirmed
        },
        isButtonAvailable() {
            return this.appeal.client_appeal_status?.name !== 'Исполнен' && ([roleEnum.Distributor].includes(this.currentRole) || [roleEnum.Executor].includes(this.currentRole))
        },
        ieIsButtonAvailable() {
            return this.appeal.client_appeal_status?.name === 'Исполнен' || this.appeal.client_appeal_status?.name === 'Отказан'
        },
        canComplete() {
            if (this.appeal.flow_type?.id === flowTypeEnum.Qoldau) {
                return ([roleEnum.Executor, roleEnum.CoExecutor].includes(this.currentRole) ||
                    ([roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor?.user.id === this.currentUser.id))
                    && this.appeal.appeal_status.id !== appealStatusEnum.Confirmed
                    && this.appeal.appeal_status.id !== appealStatusEnum.DivisionCuratorConfirm
            } else {
                return (([roleEnum.CoExecutor].includes(this.currentRole) && this.appeal.appeal_status.id !== appealStatusEnum.DistrictCuratorConfirm) ||
                    [roleEnum.Executor].includes(this.currentRole) ||
                    ([roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor?.user.id === this.currentUser.id)
                )
                    && this.appeal.appeal_status.id !== appealStatusEnum.Confirmed
                    && this.appeal.appeal_status.id !== appealStatusEnum.DivisionCuratorConfirm
                    && this.appeal.appeal_status.id !== appealStatusEnum.OnConfirmDistrictCurator
            }
        },
        canReject() {
            return ([roleEnum.Executor, roleEnum.CoExecutor].includes(this.currentRole)
                && this.appeal.appeal_status.id !== appealStatusEnum.Confirmed
                && this.appeal.appeal_status.id !== appealStatusEnum.DivisionCuratorConfirm
                && this.appeal.appeal_status.id !== appealStatusEnum.DistrictCuratorConfirm
                && this.appeal.appeal_status.id !== appealStatusEnum.OnConfirmDistrictCurator
            )
                || ([roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id)
                || ([roleEnum.UpiCurator].includes(this.currentRole) && this.appeal.upi_curator?.user.id === this.currentUser.id)
                || ([roleEnum.DistrictCurator].includes(this.currentRole) && this.appeal.district_curator?.user.id === this.currentUser.id && this.appeal.appeal_status.id === appealStatusEnum.OnConfirmDistrictCurator)
        },
        canConfirm() {
            return (
                [roleEnum.Distributor].includes(this.currentRole)
                && this.appeal.distributor.user.id === this.currentUser.id
                && this.appeal.appeal_status.id === appealStatusEnum.DivisionCuratorConfirm
            )
                || (
                    [roleEnum.UpiCurator].includes(this.currentRole)
                    && this.appeal.upi_curator?.user.id === this.currentUser.id
                    && (this.appeal.appeal_status.id === appealStatusEnum.Confirmed || this.appeal.appeal_status.id === appealStatusEnum.DistrictCuratorConfirm)
                )
                || (
                    [roleEnum.DistrictCurator].includes(this.currentRole)
                    && this.appeal.district_curator?.user.id === this.currentUser.id
                    && this.appeal.appeal_status.id === appealStatusEnum.OnConfirmDistrictCurator
                )
        },
        canDivisionDepartmentConfirm() {
            return (
                [roleEnum.DivisionCurator].includes(this.currentRole) && this.appeal.executor.department.id === this.currentUser.department.id)
                && this.appeal.appeal_status.id === appealStatusEnum.Confirmed
        },
        canEditCategory() {
            return (
                [roleEnum.Distributor].includes(this.currentRole)
                && this.appeal.distributor.user.id === this.currentUser.id
            ) && this.appeal.appeal_status.id !== appealStatusEnum.Confirmed;
        },
        canCreateNewAppeal() {
            return [roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id;
        },
        canChangeIndustry() {
            return [roleEnum.Distributor].includes(this.currentRole) && this.appeal.distributor.user.id === this.currentUser.id;
        },
        canSentToCorrection() {
            return [roleEnum.Distributor].includes(this.currentRole)
                && this.appeal
                && this.appeal.business
                && this.appeal.business.status !== 'UPDATE_REQUIRED';
        },
        lockCardActions() {
            return this.appeal?.business?.status === 'UPDATE_REQUIRED';
        },
        showAllActions() {
            return this.appeal.appeal_status.id !== appealStatusEnum.Completed
                && this.appeal.appeal_status.id !== appealStatusEnum.Rejected
                && !this.lockCardActions && (!this.appeal.in_camunda || this.bpmnActions);
        },
        hasAccount() {
            return !!(this.businessContacts && this.businessContacts[0] && this.businessContacts[0].client);
        },
    },
    watch: {
        curatorDistrictListFiltered() {
            if (this.curatorDistrictListFiltered.length === 1) {
                this.actionData.curatorDistrict = this.curatorDistrictListFiltered[0]
            }
        },
        id() {
            this.loadCard()
        },
        hasAccount() {
            // if(this.$store.getters[businessGetterType.getBusinessContacts]) {
            if (this.businessContacts && this.businessContacts[0] && this.businessContacts[0].client)
                return true
            // }
        },
        // phone() {
        //     if(this.dialog.create_account) {
        //         this.actionData.phone = this.businessContacts[0].phone_number
        //         console.log(this.businessContacts)
        // }
        // }
    },
    data() {
        return {
            vue: this,
            business: null,
            businessPhone: null,
            actionStore: null,
            appeal: null,
            appealResultTypeList: null,
            businessActivityType: null,
            tab: null,
            action: null,
            bpmnActions: null,
            headers: [
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.appealsApplication'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'client_appeal_status',
                // },
                // {
                //   text: this.$vuetify.lang.t('$vuetify.page.appeal.appealNumber'),
                //   align: 'start',
                //   sortable: true,
                //   value: 'appeal_no',
                // },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.client'),
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.category'),
                    align: 'start',
                    sortable: true,
                    value: 'category.name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.iin'),
                    align: 'start',
                    sortable: true,
                    value: 'iin',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.status'),
                    align: 'start',
                    sortable: true,
                    value: 'client_appeal_status.name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.distributor'),
                    align: 'start',
                    sortable: true,
                    value: 'distributorName',
                },
                // {
                //   text: this.$vuetify.lang.t('$vuetify.page.appeal.executor'),
                //   align: 'start',
                //   sortable: true,
                //   value: 'executor',
                // },
                // {
                //   text: this.$vuetify.lang.t('$vuetify.page.appeal.coExecutor'),
                //   align: 'start',
                //   sortable: true,
                //   value: 'co_executor',
                // },
                // {
                //   text: this.$vuetify.lang.t('$vuetify.page.appeal.upiDistrictCurator'),
                //   align: 'start',
                //   sortable: true,
                //   value: 'UpiDistrictCurator',
                // },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.source'),
                    align: 'start',
                    sortable: true,
                    value: 'appeal_source_type.name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.createDate'),
                    align: 'start',
                    sortable: true,
                    value: 'create_date',
                },
                { text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false },
            ],
            dialog: {
                complete: false,
                reject: false,
                set_executor: false,
                set_coExecutor: false,
                confirm: false,
                set_curator: false,
                edit_category: false,
                reassign_distributor: false,
                byQolday: false,
                ieAccess: false,
                ieReject: false,
                notByQolday: false,
                clarification: false,
                create_account: null,
            },
            actionData: {
                comment: null,
                executor: null,
                distributor: null,
                coExecutor: null,
                curatorUpi: null,
                curatorDistrict: null,
                district: null,
                appealResultType: null,
                category: null,
                industry: null,
                files: null,
                phone: null,
                byQoldayProduct: null,
            },
            fails: {
                files: [],
            },
        }
    },
    methods: {
        getUrl(val) {
            return "../../storage/" + `${val}`
        },
        checkRole() {
            if (this.currentRole === roleEnum.IEManager) {
                return true
            } else {
                return false
            }
        },
        openCreateAccount() {
            this.dialog.create_account = true;
            this.businessPhone = '+7' + this.businessContacts[0].phone_number
        },
        gotoWhatsapp(valueContact) {
            window.open('https://wa.me/7' + `${valueContact}`);
        },
        getFieldFails(field) {
            if (this.fails[field] && this.fails[field].length) {
                return this.fails[field]?.slice(0, 1)[0];
            }
            return "";
        },
        showCard(item) {
            if (this.id !== item.id) {
                this.$router.push({ name: 'AppealCard', params: { id: item.id } })
            }
        },
        contactForCreate() {
            this.dialog.create_account = true;
            this.businessPhone = this.businessContacts[0].phone
        },
        createAccount() {
            console.log(this.businessPhone, this.appeal?.business?.organization?.profile?.user?.id)
            if (this.$refs.accountActionform.validate()) {
                return new Promise((resolve, reject) => {
                    this.$store.dispatch(businessActionType.businessCreateAccount, {
                        id: this.appeal.business.id,
                        phone: this.businessPhone
                    }).then((response) => {
                        if (response.fails) {
                            this.fails = response.fails;
                            resolve()
                        } else {
                            this.loadCard()
                            this.dialog.create_account = false
                            resolve()
                        }
                    })
                })
            }
        },
        closeDialog() {
            this.dialog.create_account = false;
            this.dialog.reassign_distributor = false;

            this.actionData.phone = null;
            this.actionData.reassign_distributor = null;
        },
        resetFails() {
            this.fails = {
                files: [],
            };
        },
        isFieldFailed(field) {
            return this.getFieldFails(field).length > 0;
        },
        profileFio(profile) {
            return profile ? `${profile.last_name} ${profile.first_name}` : 'Нет'
        },
        getToWork() {
            this.$store.dispatch(this.actionStore.getToWork, { id: this.id }).then((data) => {
                this.loadCard().then(() => {
                    this.$refs.appealHistory.refreshHistory()
                })
            })
        },
        loadCard(candidateGroup) {
            return new Promise((resolve, reject) => {
                this.$store.dispatch(this.actionStore.retrieveAppeal, { id: this.id }).then((data) => {
                    this.appeal = data
                    if (this.appeal?.district_curator?.user.id === this.$store.state.loggedUser.user.id)
                        this.$store.dispatch(dictionaryActionType.retrieveCoExecutorDictionaryListByDepartment, { department_id: this.$store.state.loggedUser.user.department.id })
                    else
                        this.$store.dispatch(dictionaryActionType.retrieveCoExecutorDictionaryList)

                    if (this.appeal.business) {
                        this.$store.dispatch(businessActionType.businessContacts, { business_id: this.appeal.business?.id })
                        this.$store.dispatch(businessActionType.businessPhotos, { business_id: this.appeal.business?.id })
                        this.$store.dispatch(businessActionType.businessActivityType, { business_id: this.appeal.business?.id }).then((response) => {
                            this.businessActivityType = response[0]
                        })
                    }

                    if (this.appeal.in_camunda) {
                        this.$store.dispatch(bpmnActionType.getTask, {
                            processDefinitionKey: 'Process_Upi_Qolday_Client_Request',
                            candidateGroup,
                            user: this.currentUser.id,
                            businessKey: this.id,
                        }).then((response) => {
                            this.bpmnActions = response
                        })
                    }
                    resolve()
                })
            })
        },
        getAppealResultType(toAppealStatus) {
            return new Promise((resolve, reject) => {
                this.$store.dispatch(dictionaryActionType.retrieveAppealResultTypeList, {
                    appeal_id: this.id,
                    to_appeal_status_id: toAppealStatus
                }).then((data) => {
                    if (toAppealStatus === appealStatusEnum.Rejected && this.isSetCanContactToday) {
                        this.appealResultTypeList = data.filter(item => {
                            if (item.id !== appealResultTypeEnum.cantContact) {
                                return item
                            }
                        })
                    } else {
                        this.appealResultTypeList = data
                    }
                    resolve()
                })
            })
        },
        cantContact() {
            this.action = actionEnum.cant_contact
            this.callAction()
        },
        assignCuratorAppeal() {
            this.action = actionEnum.set_curator
            this.callAction()
        },
        reAssignDistributorAppeal() {
            this.action = actionEnum.reassign_distributor
            this.callAction()
        },
        assignExecutorAppeal() {
            this.action = actionEnum.set_executor
            this.callAction()
        },
        assignCoExecutorAppeal() {
            this.action = actionEnum.set_coExecutor
            this.callAction()
        },
        returnForRevisionAppeal() {
            this.action = actionEnum.return_for_revision
            this.callAction()
        },
        ieConsultationAccess() {
            this.action = actionEnum.consultation_access
            this.callAction()
        },
        ieConsultationReject() {
            this.action = actionEnum.consultation_reject
            console.log('asd');

            this.callAction()
        },
        consultationProvidedQolday() {
            this.action = actionEnum.consultation_provided_qolday
            this.callAction()
        },
        consultationProvidedNotQolday() {
            this.action = actionEnum.consultation_provided_not_qolday
            this.callAction()
        },
        requiresClarification() {
            this.action = actionEnum.requires_clarification
            this.callAction()
        },
        completeAppeal() {
            this.action = actionEnum.complete
            this.callAction()
        },
        confirmAppeal() {
            this.action = actionEnum.confirm
            this.callAction()
        },
        divisionDepartmentConfirmAppeal() {
            this.action = actionEnum.division_department_confirm
            this.callAction()
        },
        rejectAppeal() {
            this.action = actionEnum.reject
            this.callAction()
        },
        editCategory() {
            this.action = actionEnum.edit_category
            this.callAction()
        },
        clearActionData() {
            this.actionData.comment = null
            this.actionData.executor = null
            this.actionData.coExecutor = null
            this.actionData.curatorUpi = null
            this.actionData.curatorDistrict = null
            this.actionData.district = null
            this.actionData.industry = null
            this.actionData.files = null
            this.actionData.byQoldayProduct = null
        },
        callAction() {
            switch (this.action) {
                case actionEnum.create: {
                    this.clearActionData()
                    break
                }
                case actionEnum.edit: {
                    this.clearActionData()
                    break
                }
                case actionEnum.set_executor: {
                    this.clearActionData()
                    this.actionData.executor = Object.assign({}, this.appeal.executor)
                    this.actionData.district = Object.assign({}, this.appeal.district)
                    this.dialog.set_executor = true
                    break
                }
                case actionEnum.set_coExecutor: {
                    this.clearActionData()
                    this.actionData.co_executor = Object.assign({}, this.appeal.co_executor)
                    this.dialog.set_coExecutor = true
                    break
                }
                case actionEnum.return_for_revision: {
                    this.applyAction()
                    break
                }
                case actionEnum.consultation_provided_qolday: {
                    // this.applyAction()
                    this.clearActionData()
                    this.dialog.byQolday = true
                    break
                }
                case actionEnum.consultation_provided_not_qolday: {
                    this.clearActionData()
                    this.dialog.notByQolday = true
                    break
                }
                case actionEnum.consultation_access: {
                    this.clearActionData()
                    this.dialog.ieAccess = true
                    break
                }
                case actionEnum.consultation_reject: {
                    this.clearActionData()
                    this.dialog.ieReject = true
                    break
                }
                case actionEnum.requires_clarification: {
                    this.clearActionData()
                    this.dialog.clarification = true
                    break
                }
                case actionEnum.complete: {
                    this.clearActionData()
                    this.getAppealResultType(appealStatusEnum.Completed).then(() => {
                        this.dialog.complete = true
                    })
                    break
                }
                case actionEnum.reject: {
                    this.clearActionData()
                    this.getAppealResultType(appealStatusEnum.Rejected).then(() => {
                        this.dialog.reject = true
                    })
                    break
                }
                case actionEnum.confirm: {
                    this.clearActionData()
                    this.dialog.confirm = true
                    break
                }
                case actionEnum.set_curator: {
                    this.clearActionData()
                    this.dialog.set_curator = true
                    break
                }
                case actionEnum.division_department_confirm: {
                    this.clearActionData()
                    this.dialog.confirm = true
                    break
                }
                case actionEnum.edit_category: {
                    this.clearActionData()
                    this.actionData.category = this.appeal.category;
                    this.dialog.edit_category = true;
                    break
                }
                case actionEnum.reassign_distributor: {
                    this.clearActionData()
                    this.dialog.reassign_distributor = true;
                    break
                }
                case actionEnum.cant_contact: {
                    this.applyAction()
                    break
                }
            }
        },
        applyAction() {
            new Promise((resolve, reject) => {
                switch (this.action) {
                    case actionEnum.create: {
                        break
                    }
                    case actionEnum.edit: {
                        break
                    }
                    case actionEnum.set_executor: {
                        if (this.$refs.assignExecutorActionform.validate()) {

                            let payload = {
                                id: this.id,
                                executor_id: this.actionData.executor.user.id,
                                district_id: this.actionData.district.id,
                                comment: this.actionData.comment,
                            };

                            if (this.canChangeIndustry) {
                                payload = {
                                    id: this.id,
                                    executor_id: this.actionData.executor.user.id,
                                    district_id: this.actionData.district.id,
                                    comment: this.actionData.comment,
                                    industry_id: this.actionData.industry.id,
                                };
                            }

                            this.$store.dispatch(this.actionStore.assignExecutor, payload).then(() => {
                                this.loadCard()
                                this.dialog.set_executor = false
                                resolve()
                            })
                        }
                        break
                    }
                    case actionEnum.set_coExecutor: {
                        if (this.$refs.assignCoExecutorActionform.validate()) {
                            this.$store.dispatch(this.actionStore.assignCoExecutor, {
                                id: this.id,
                                co_executor_id: this.actionData.coExecutor.user.id,
                                comment: this.actionData.comment
                            }).then(() => {
                                this.loadCard()
                                this.dialog.set_coExecutor = false
                                resolve()
                            })
                        }
                        break
                    }
                    case actionEnum.return_for_revision: {
                        this.$store.dispatch(this.actionStore.backToWork, {
                            id: this.id
                        }).then(() => {
                            this.loadCard()
                            this.dialog.complete = false
                            resolve()
                        })
                        break
                    }
                    case actionEnum.complete: {
                        if (this.$refs.completeActionform.validate()) {
                            this.$store.dispatch(this.actionStore.complete, {
                                id: this.id,
                                comment: this.actionData.comment,
                                appeal_result_type_id: this.actionData.appealResultType.id,
                                files: this.actionData.files,
                            }).then((response) => {
                                if (response.fails) {
                                    this.fails = response.fails;
                                    resolve()
                                } else {
                                    this.loadCard()
                                    this.dialog.complete = false
                                    resolve()
                                }
                            })
                        }
                        break
                    }
                    case actionEnum.reject: {
                        if (this.$refs.rejectActionform.validate()) {
                            this.$store.dispatch(this.actionStore.reject, {
                                id: this.id,
                                comment: this.actionData.comment,
                                appeal_result_type_id: this.actionData.appealResultType.id,
                                files: this.actionData.files,
                            }).then((response) => {
                                if (response.fails) {
                                    this.fails = response.fails;
                                    resolve()
                                } else {
                                    this.loadCard()
                                    this.dialog.reject = false
                                    resolve()
                                }
                            })
                        }
                        break
                    }
                    case actionEnum.consultation_provided_qolday: {
                        this.$store.dispatch(this.actionStore.consultationProvidedQolday, {
                            id: this.id,
                            byQoldayProduct: this.actionData.byQoldayProduct,
                            comment: this.actionData.comment
                        }).then(() => {
                            this.loadCard()
                            this.dialog.byQolday = false
                            resolve()
                        })
                        break
                    }
                    case actionEnum.consultation_access: {
                        this.$store.dispatch(this.actionStore.ie_consultation_access, {
                            id: this.id,
                            comment: this.actionData.comment
                        }).then(() => {
                            this.loadCard()
                            this.dialog.ieAccess = false
                            resolve()
                        })
                        break
                    }
                    case actionEnum.consultation_reject: {
                        console.log('asd');
                        this.$store.dispatch(this.actionStore.ie_consultation_reject, {
                            id: this.id,
                            comment: this.actionData.comment
                        }).then(() => {
                            this.loadCard()
                            this.dialog.ieReject = false
                            resolve()
                        })
                        break
                    }
                    case actionEnum.consultation_provided_not_qolday: {
                        this.$store.dispatch(this.actionStore.consultationProvidedNotQolday, {
                            id: this.id,
                            comment: this.actionData.comment
                        }).then(() => {
                            this.loadCard()
                            this.dialog.notByQolday = false
                            resolve()
                        })
                        break
                    }
                    case actionEnum.requires_clarification: {
                        this.$store.dispatch(this.actionStore.requiresClarification, {
                            id: this.id,
                            comment: this.actionData.comment
                        }).then(() => {
                            this.loadCard()
                            this.dialog.clarification = false
                            resolve()
                        })
                        break
                    }
                    case actionEnum.confirm:
                    case actionEnum.division_department_confirm: {
                        if (this.$refs.confirmActionform.validate()) {
                            this.$store.dispatch(this.actionStore.complete, {
                                id: this.id,
                                comment: this.actionData.comment
                            }).then(() => {
                                this.loadCard()
                                this.dialog.confirm = false
                                resolve()
                            })
                        }
                        break
                    }
                    case actionEnum.set_curator: {
                        if (this.$refs.setCuratorActionform.validate()) {
                            this.$store.dispatch(this.actionStore.assignCurator, {
                                id: this.id,
                                curator_upi_id: this.actionData.curatorUpi.user.id,
                                curator_district_id: this.actionData.curatorDistrict.user.id,
                                district_id: this.actionData.district.id,
                                industry_id: this.actionData.industry.id,
                                comment: this.actionData.comment,
                            }).then(() => {
                                this.loadCard()
                                this.dialog.set_curator = false
                                resolve()
                            })
                        }
                        break
                    }
                    case actionEnum.edit_category: {
                        if (this.$refs.setCategoryActionform.validate()) {
                            this.$store.dispatch(this.actionStore.editCategory, {
                                id: this.id,
                                category_id: this.actionData.category.id,
                            }).then(() => {
                                this.loadCard()
                                this.dialog.edit_category = false
                                resolve()
                            })
                        }
                        break
                    }
                    case actionEnum.reassign_distributor: {
                        if (this.$refs.reassignDistributorForm.validate()) {
                            this.$store.dispatch(this.actionStore.reassignDistributor, {
                                id: this.id,
                                distributor_id: this.actionData.distributor.user.id,
                            }).then(() => {
                                this.loadCard()
                                this.dialog.reassign_distributor = false
                                resolve()
                            })
                        }
                        break
                    }
                    case actionEnum.cant_contact: {
                        this.$store.dispatch(this.actionStore.cantContact, {
                            id: this.id
                        }).then(() => {
                            this.loadCard()
                            resolve()
                        })
                        break
                    }
                }
            }).then(() => {
                this.$refs.appealHistory.refreshHistory()
            })
        },
        getAnswerFromValue(value) {
            return value ? this.$vuetify.lang.t('$vuetify.page.action.btnYes') : this.$vuetify.lang.t('$vuetify.page.action.btnNo')
        },
        createNewAppeal() {
            this.$router.push({ name: 'ChildAppealCard', params: { parentId: this.appeal.id } })
        },
        sentToCorrection() {
            return new Promise((resolve, reject) => {
                this.$store.dispatch(businessActionType.businessSentToCorrection, {
                    id: this.appeal.business.id,
                }).then(() => {
                    this.loadCard()
                    resolve()
                })
            })
        },
        existInBpmnActions(actionName) {
            if (this.appeal.in_camunda) {
                return !!this.bpmnActions.find(item => item.taskDefinitionKey === actionName)
            }
            return true
        }
    },
    destroyed() {
        this.$store.dispatch(businessActionType.businessContactsClear)
        this.$store.dispatch(businessActionType.businessPhotosClear)
    }
}
</script>

<style scoped>

</style>
