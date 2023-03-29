import roleEnum from './roleEnum'
import filterEnum from './filterEnum'

const availableFilters = [
    {
        roles: [
            roleEnum.Administrator,
            roleEnum.Head,
            roleEnum.UpiCurator,
            roleEnum.Distributor,
            roleEnum.Executor,
        ],
        pages: ['AppealsSandbox'],
        filters: [
            filterEnum.districtId,
            filterEnum.appealStatusId,
            // filterEnum.appealResultTypeId,
            filterEnum.categoryId,
            filterEnum.sourceTypeId,
            // filterEnum.executorId,
            // filterEnum.coExecutorId,
            // filterEnum.lastCuratorDistrictId,
            // filterEnum.lastCuratorUpiId,
            filterEnum.distributorId,
            // filterEnum.isInUpi,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.IEManager,
        ],
        pages: ['AppealsSandbox'],
        filters: [
            //filterEnum.districtId,
            filterEnum.appealStatusId,
            // filterEnum.appealResultTypeId,
            filterEnum.categoryId,
            //filterEnum.sourceTypeId,
            // filterEnum.executorId,
            // filterEnum.coExecutorId,
            // filterEnum.lastCuratorDistrictId,
            // filterEnum.lastCuratorUpiId,
            //filterEnum.distributorId,
            // filterEnum.isInUpi,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.Administrator,
            roleEnum.Head,
            roleEnum.UpiCurator,
            roleEnum.Distributor,
            roleEnum.Executor,
        ],
        pages: ['completed'],
        filters: [
            filterEnum.districtId,
            filterEnum.appealStatusId,
            // filterEnum.appealResultTypeId,
            filterEnum.categoryId,
            filterEnum.sourceTypeId,
            // filterEnum.executorId,
            // filterEnum.coExecutorId,
            // filterEnum.lastCuratorDistrictId,
            // filterEnum.lastCuratorUpiId,
            // filterEnum.distributorId,
            // filterEnum.isInUpi,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.Administrator,
            roleEnum.Head,
            roleEnum.UpiCurator,
            roleEnum.Distributor,
            roleEnum.Executor,
        ],
        pages: ['in_work'],
        filters: [
            // filterEnum.districtId,
            filterEnum.appealStatusId,
            // filterEnum.appealResultTypeId,
            filterEnum.categoryId,
            filterEnum.sourceTypeId,
            // filterEnum.executorId,
            // filterEnum.coExecutorId,
            // filterEnum.lastCuratorDistrictId,
            // filterEnum.lastCuratorUpiId,
            // filterEnum.distributorId,
            // filterEnum.isInUpi,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.UpiHead
        ],
        pages: ['MyAppeals'],
        filters: [
            filterEnum.districtId,
            filterEnum.sourceTypeId,
            filterEnum.categoryId,
            filterEnum.executorId,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.UpiHead,
            roleEnum.Executor,
        ],
        pages: ['AppealsSandbox'],
        filters: [
            filterEnum.districtId,
            filterEnum.appealResultTypeId,
            filterEnum.categoryId,
            filterEnum.sourceTypeId,
            filterEnum.executorId,
            filterEnum.coExecutorId,
            filterEnum.lastCuratorDistrictId,
            filterEnum.lastCuratorUpiId,
            filterEnum.isInUpi,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.Administrator,
            roleEnum.Executor,
            roleEnum.Client,
            roleEnum.Distributor,
            roleEnum.CoExecutor,
            roleEnum.Head,
            roleEnum.UpiCurator,
            roleEnum.DistrictCurator,
            roleEnum.DivisionCurator,
            roleEnum.UpiHead,
            roleEnum.Executor,
        ],
        pages: ['BusinessList'],
        filters: [
            filterEnum.districtId,
            // filterEnum.cityId,
            filterEnum.distributorId,
            filterEnum.status,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
    {
        roles: [
            roleEnum.Administrator,
            roleEnum.Executor,
            roleEnum.Client,
            roleEnum.Distributor,
            roleEnum.CoExecutor,
            roleEnum.Head,
            roleEnum.UpiCurator,
            roleEnum.DistrictCurator,
            roleEnum.DivisionCurator,
            roleEnum.UpiHead
        ],
        pages: ['MyBusinessList'],
        filters: [
            filterEnum.districtId,
            // filterEnum.cityId,
            filterEnum.status,
            filterEnum.startDate,
            filterEnum.endDate,
        ]
    },
]

export default availableFilters
