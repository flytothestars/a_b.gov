export default {
	$vuetify: {
		badge: 'знак',
		close: 'Закрыть',
		dataIterator: {
			noResultsText: 'Не найдено подходящих записей',
			loadingText: 'Запись загружается...',
		},
		dataTable: {
			itemsPerPageText: 'Строк на странице:',
			ariaLabel: {
				sortDescending: 'Упорядочено по убыванию.',
				sortAscending: 'Упорядочено по возрастанию.',
				sortNone: 'Не упорядочено.',
				activateNone: 'Активируйте, чтобы убрать сортировку.',
				activateDescending: 'Активируйте для упорядочивания убыванию.',
				activateAscending: 'Активируйте для упорядочивания по возрастанию.',
			},
			sortBy: 'Сортировать по',
		},
		dataFooter: {
			itemsPerPageText: 'Записей на странице:',
			itemsPerPageAll: 'Все',
			nextPage: 'Следующая страница',
			prevPage: 'Предыдущая страница',
			firstPage: 'Первая страница',
			lastPage: 'Последняя страница',
			pageText: '{0}-{1} из {2}',
		},
		datePicker: {
			itemsSelected: '{0} выбран',
			nextMonthAriaLabel: 'Следующий месяц',
			nextYearAriaLabel: 'Следующий год',
			prevMonthAriaLabel: 'Прошлый месяц',
			prevYearAriaLabel: 'Предыдущий год',
		},
		noDataText: 'Отсутствуют данные',
		carousel: {
			prev: 'Предыдущий слайд',
			next: 'Следующий слайд',
			ariaLabel: {
				delimiter: 'Слайд {0} из {1}',
			},
		},
		calendar: {
			moreEvents: 'Еще {0}',
		},
		fileInput: {
			counter: 'Файлов: {0}',
			counterSize: 'Файлов: {0} (всего {1})',
		},
		timePicker: {
			am: 'AM',
			pm: 'PM',
		},
		pagination: {
			ariaLabel: {
				wrapper: 'Навигация по страницам',
				next: 'Следующая страница',
				previous: 'Предыдущая страница',
				page: 'Перейти на страницу {0}',
				currentPage: 'Текущая страница, Страница {0}',
			},
		},
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
				search: 'Поиск'
			},
			action: {
				btnCustom: 'Индивидуальный',
				btnSave: 'Сохранить',
				btnUpdate: 'Обновить',
				btnDownload: 'Скачать',
				btnDownload2: 'Ok',
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
				btnSend: 'Отправить',
				btnPublish: 'Опубликовать',
				btnUnPublish: 'Снять публикацию',
				formAddTitle: 'Добавить \'{0}\'',
				formEditTitle: 'Редактировать \'{0}\'',
				requiredField: '* указывает на обязательное поле',
				confirmDelete: 'Вы уверены, что хотите удалить \'{0}\'?',
				titleAction: 'Действия',
				titleDataNotFound: 'Данные не найдены',
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
				name: 'Отчет по районам',
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
				name: '',
			},
			appeal: {
				category: 'Категория',
				industryAppeal: 'Вид деятельности по обращению',
				industry: 'Вид деятельности',
				createDate: 'Дата создания',
				updateDate: 'Дата изменения',
				client: 'Заявитель',
				content: 'Содержание',
				status: 'Статус',
				distributor: 'Консультант',
				executor: 'Исполнитель',
				coExecutor: 'Соисполнитель',
				upiCurator: 'Куратор УПИ',
				districtCurator: 'Куратор района',
				source: 'Источник',
				company: 'Компания',
				iin: 'БИН/ИИН',
				bin: 'БИН',
				district: 'Район',
				contacts: 'Контакты',
				card: {
					tabs: {
						general: 'Основная информация',
						photo: 'Файлы',
						additional_info: 'дополнительная информация',
						appeals: 'Обращения',
					}
				},
				upiDistrictCurator: 'Куратор УПИ / Куратор района',
				appealNumber: '№',
			},
			business: {
				signboard: 'Вывеска',
				city: 'Город',
				district: 'Район',
				county: 'Округ',
				Category: 'Категория',
				AddressLine: 'Строка адреса',
				AddressStringFromStat: 'Строка адреса из стат',
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
		}
	}
}
