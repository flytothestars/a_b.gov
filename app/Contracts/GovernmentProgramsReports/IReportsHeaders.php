<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportsHeaders
{
    public const Id                 = 'id';
    public const ReportType         = 'report_type';
    public const ReportImportStatus = 'status';
    public const ImportDate         = 'import_date';
    public const LastFailComment    = 'last_fail_comment';
    public const ImportUserId       = 'import_user_id';
    public const LastEditorId       = 'last_editor_id';
    public const CreatedAt          = 'created_at';
    public const UpdatedAt          = 'updated_at';

    public const File = 'file';

    public const FieldList = [
        self::Id,
        self::ReportType,
        self::ReportImportStatus,
        self::ImportDate,
        self::LastFailComment,
        self::ImportUserId,
        self::LastEditorId,
        self::CreatedAt,
        self::UpdatedAt,
    ];


}
