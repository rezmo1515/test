import { useMemo } from 'react';
import { formatPersianDate } from '../../utils/date.js';
import StatusBadge from '../common/StatusBadge.jsx';

const statusConfig = {
  active: { label: 'فعال', tone: 'success' },
  inactive: { label: 'غیرفعال', tone: 'neutral' },
  leave: { label: 'مرخصی', tone: 'warning' }
};

const EmploymentType = ({ job }) => {
  if (!job?.employment_type) return 'نامشخص';
  const mapping = {
    full_time: 'تمام وقت',
    part_time: 'پاره وقت',
    contract: 'قراردادی',
    internship: 'کارآموزی'
  };
  return mapping[job.employment_type] || job.employment_type;
};

const resolvePositionTitle = (job) => {
  if (!job) return 'بدون سمت';
  return job.position?.title || job.position_title || 'بدون سمت';
};

const EmployeeTable = ({ employees, departments }) => {
  const departmentLookup = useMemo(() => {
    const table = new Map();
    (departments || []).forEach((item) => table.set(item.id, item.name));
    return table;
  }, [departments]);

  if (!employees.length) {
    return <div className="empty-state">هیچ کارمندی یافت نشد.</div>;
  }

  return (
    <div className="table-wrapper">
      <table className="data-table">
        <thead>
          <tr>
            <th>نام و نام خانوادگی</th>
            <th>کد پرسنلی</th>
            <th>دپارتمان</th>
            <th>نوع همکاری</th>
            <th>وضعیت</th>
            <th>تاریخ استخدام</th>
            <th>ایمیل سازمانی</th>
          </tr>
        </thead>
        <tbody>
          {employees.map((employee) => {
            const job = employee.job || {};
            const contact = employee.contact || {};
            const status = statusConfig[job.employment_status] || {
              label: job.employment_status || 'نامشخص',
              tone: 'neutral'
            };
            return (
              <tr key={employee.id}>
                <td data-title="نام و نام خانوادگی">
                  <div className="table-name-cell">
                    <div className="avatar" aria-hidden="true">
                      {(employee.first_name?.[0] || employee.last_name?.[0] || 'ک').toUpperCase()}
                    </div>
                    <div>
                      <strong>{`${employee.first_name || ''} ${employee.last_name || ''}`.trim() || 'نامشخص'}</strong>
                      <span>{resolvePositionTitle(job)}</span>
                    </div>
                  </div>
                </td>
                <td data-title="کد پرسنلی">{job.personnel_code || '---'}</td>
                <td data-title="دپارتمان">{departmentLookup.get(job.department_id) || 'نامشخص'}</td>
                <td data-title="نوع همکاری"><EmploymentType job={job} /></td>
                <td data-title="وضعیت">
                  <StatusBadge tone={status.tone}>{status.label}</StatusBadge>
                </td>
                <td data-title="تاریخ استخدام">{formatPersianDate(job.hire_date)}</td>
                <td data-title="ایمیل سازمانی">{contact.work_email || '---'}</td>
              </tr>
            );
          })}
        </tbody>
      </table>
    </div>
  );
};

export default EmployeeTable;
