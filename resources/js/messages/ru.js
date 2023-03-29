import ru from 'vuetify/src/locale/ru.ts'

export default {
	$vuetify: {
		...ru,
		companyName: 'Yupi',
		auth: {
			login: {
				formTitle: 'Авторизация',
				userName: 'Имя пользователя',
				password: 'Пароль',
				loginBtn: 'Войти',
				registrationBtn: 'Регистрация',
			}
		},
		page: {
			Home: {
				name: ''
			},
			ProfileAdmin: {
				name: 'Профиль',
			},
			all: {
				details: 'Детали',
				history: "История",
				createdBy: 'Создал',
				createAt: 'Дата создания',
				updateBy: 'Изменил',
				updateAt: 'Дата изменения',
				state: 'Статус',
				settings: 'Настройки',
				activate: 'Активность',
				options: 'Настройки',
				quickAccess: 'Быстрый доступ',
				deleteMsg: 'Вы уверенны что хотите удалить эту запись?',
				search: 'Поиск',
			},
			action: {
				btnCustom: 'Индивидуальный',
				btnSave: 'Сохранить',
				apply: 'Применить',
				btnUpdate: 'Обновить',
				btnDownload: 'Скачать',
				btnDownload2: 'ok',
				btnDownload3: 'Клиенты',
				btnClose: 'Закрыть',
				btnCancel: 'Отмена',
				btnAdd: 'Добавить',
				btnEdit: 'Редактировать',
				btnDelete: 'Удалить',
				btnFilter: 'Фильтр',
				btnClear: 'Очистить',
				btnShow: 'Просмотреть',
				btnNext: 'Дальше',
				btnBack: 'Назад',
				btnYes: 'Да',
				btnNo: 'Нет',
				btnSend: 'Отправить',
				btnPublish: 'Опубликовать',
				btnUnPublish: 'Снять публикацию',
				formAddTitle: 'Добавить \'{0}\'',
				formEditTitle: 'Редактировать \'{0}\'',
				requiredField: '* указывает на обязательное поле',
				confirmDelete: 'Вы уверены, что хотите удалить \'{0}\'?',
				titleAction: 'Действия',
				titleDataNotFound: 'Данные не найдены',
				assignToMe: 'Назначить на меня',
				filter: 'Фильтр'
			},
			UserList: {
				name: 'Список пользователей',
				title: 'Пользователь',
				crudName: 'Пользователя',
				username: 'Имя',
				email: 'Email',
				password: 'Пароль',
				password_confirmation: 'Повторение пароля',
				department: 'Департамент',
				position: 'Должность',
				role: 'Роль',
				phone: 'Телефон',
				lastName: 'Фамилия',
				firstName: 'Имя',
				secondName: 'Отчество',
			},
			AppealsSandbox: {
				name: 'Новые заявки'
			},
			MyAppeals: {
				name: 'Мои заявки',
				toWork: {
					name: 'Мои обращения - требуют назначения',
				},
				inWork: {
					name: 'Мои заявки - в работе',
				},
				completed: {
					name: 'Мои заявки - исполненные',
				},
				confirmation: {
					name: 'Мои обращения - на подтверждение',
				},
				distributor_assigned: {
					name: 'Мои обращения - на распределении',
				},
				Qolday: {
					inWork: {
						name: 'Обращения Qolday - в работе',
					},
					completed: {
						name: 'Обращения Qolday - исполненные',
					},
				},
				UPI: {
					inWork: {
						name: 'Обращения УПиИ - в работе',
					},
					completed: {
						name: 'Обращения УПиИ - исполненные',
					},
				},
				business: {
					correction: {
						name: 'Мои обращения - на коррекции'
					},
				},
			},
			AppealCard: {
				name: 'Обращение'
			},
			ChildAppealCard: {
				name: 'Создать обращение на основе существующего',
			},
			NewsList: {
				name: 'Новости',
			},
			NewsEditor: {
				name: 'Редактировать новостей',
			},
			NewsCreator: {
				name: 'Добавить новость',
			},
			BusinessCard: {
				name: 'Бизнес',
			},
			Business: {
				name: 'Бизнес',
				appeal: {
					name: 'Бизнес - c обращениями'
				},
				'no-appeal': {
					name: 'Бизнес - без обращений'
				}
			},
			MyBusinessList: {
				name: 'Мой бизнес',
			},
			BusinessAppealCard: {
				name: 'Создать обращение',
			},
			ReportList: {
				name: 'Отчеты',
				title: 'Отчет',
			},
			CityReportEdit: {
				name: 'Отчет по городу',
			},
			DistrictReportEdit: {
				name: 'Отчет по району',
			},
			InvestmentsReport: {
				name: '',
				title: 'Отчет СЭР Инвестиции',
			},
			BusinessStatReport: {
				name: '',
				title: 'Отчет Статистика предприятий',
			},
			IndustryReport: {
				name: '',
				title: 'Отчет СЭР Промышленность',
			},
			TradeReport: {
				name: '',
				title: 'Отчет СЭР Торговля',
			},
			PRTReport: {
				name: '',
				title: 'Отчет ПРТ',
			},
			UsersReport: {
				name: '',
				title: 'Отчет по пользователям',
			},
			GovernmentProgramsReports: {
				name: '',
				title: 'Отчеты по гос. программе',
			},
			ReportForm: {
				name: 'Обращения',
			},
			MIOActualisation: {
				name: 'Актуализация МСБ'
			},
			CreativeAnalytics: {
				name: 'Креативная аналитика'
			},
			PromzoneAnalytics: {
				name: 'Обрабатывающая промышленность'
			},
			ConsultationNeeds: {
				name: 'Потребности в консультации'
			},
			MIOIndustries: {
				name: ''
			},
			GovernmentProgramsReportRows: {
				failed: {
					name: 'Отчеты по гос. программе - редактор',
				},
				success: {
					name: 'Отчеты по гос. программе - редактор',
				},
				common: {
					name: 'Отчеты по гос. программе - редактор',
				},
			},
			GovernmentProgramsReportEditor: {
				name: 'Отчеты по гос. программе - редактировать запись',
			},
			GovernmentProgramsReportView: {
				name: 'Отчеты по гос. программе - просмотр',
			},
			InnerReportsView: {
				name: 'Отрасли',
			},
			Camunda: {
				ClientSettings: {
					name: 'Настройки клиента',
					workerWebhookUrl: 'Рабочий WebHook',
					workerWebhookSecret: 'Секретный ключ для WebHook'
				},
				AppealsTest: {
					name: 'Тестирование обращений',
					id: 'ID Обращения'
				}
			},
			appeal: {
				category: 'Категория заявки',
				industryAppeal: 'Вид деятельности по обращению',
				industry: 'Вид деятельности',
				createDate: 'Дата создания',
				updateDate: 'Дата изменения',
				client: 'Заявитель',
				content: 'Описание',
				status: 'Статус',
				distributor: 'Консультант',
				executor: 'Исполнитель',
				coExecutor: 'Соисполнитель',
				upiCurator: 'Куратор УПиИ',
				districtCurator: 'Куратор района',
				source: 'Источник',
				company: 'Компания',
				iin: 'БИН/ИИН',
				bin: 'БИН',
				district: 'Район',
				contacts: 'Контакты',
				file: 'Файлы',
				card: {
					tabs: {
						general: 'Основная информация',
						photo: 'Файлы',
						additional_info: 'дополнительная информация',
						appeals: 'Обращения',
						bpmn: 'BPMN',
					},
					upiDistrictCurator: 'Куратор УПИ / Куратор района',
				},
				appealNumber: '№',
				appealsApplication: 'Заявка'
			},
			business: {
				signboard: 'Вывеска',
				city: 'Город',
				district: 'Район',
				county: 'Округ',
				Category: 'Категория',
				AddressLine: 'Строка адреса',
				AddressStringFromStat: 'Район',
				Source: 'Источник',
				activitySubclasses: 'Подклассы деятельности',
				Subjects: 'Субъекты',
				numberOfEmployees: 'Число работников',
				AvailabilityOfKKM: 'Наличие ККМ',
				NumberOfCashDesks: 'Количество касс',
				POSTerminalAvailability: 'Наличие POS терминала',
				NeedToContact: 'Необходимо связаться',
				RefusalToProvideIINBIN: 'Отказ в предоставлении ИИН/БИН',
				IINNotFoundInBNS: 'ИИН не найден в БНС',
				valueEmpty: 'Не задано',
				lastCallDate: 'Последний обзвон',
				status: 'Статус',
				working_type: 'Вид деятельности',
				source: {
					FIELD_WORK: 'Полевой обход ',
					null: 'Не задано',
				},
				distributor: 'Консультант',
			},
			news: {
				published: 'Опубликованы',
				unpublished: 'Не опубликованы',
				date: 'Дата публикации',
				category: 'Категория',
				header: 'Заголовок',
			},
			report: {
				lastError: 'Ошибка обработки',
			}
		},
		menu: {
			account: 'Учетная запись',
			logout: 'Выход'
		},
		validation: {
			required: 'Обязательное поле',
			onlyString: 'Только буквы',
			onlyNumber: 'Только цифры',
			onlyStringAndNumber: 'Цифры и буквы',
			email: 'Не валидный Email',
			newPassword: 'Пароль должен содержать как минимум 1 заглавную, 1 строчную, 1 цифру и 1 специальный символ. Минимальная длина 8 символов',
			confirmPassword: 'Пароль должен совпадать',
			phone: 'Неверный формат телефона',
			minLength: 'Длина должна быть больше {0}',
			maxLength: 'Длина должна быть меньше {0}',
			minVal: 'Значение должно быть больше {0}',
			maxVal: 'Значение должно быть меньше {0}',
		},
	}
}
