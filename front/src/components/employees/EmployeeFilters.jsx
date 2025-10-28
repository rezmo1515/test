import { useMemo } from 'react';

const employmentStatusOptions = [
  { value: '', label: 'همه وضعیت‌ها' },
  { value: 'active', label: 'فعال' },
  { value: 'inactive', label: 'غیرفعال' },
  { value: 'leave', label: 'مرخصی' }
];

const EmployeeFilters = ({ filters, departments = [], onChange, onSubmit, onReset }) => {
  const departmentOptions = useMemo(() => [
    { value: '', label: 'همه دپارتمان‌ها' },
    ...departments.map((department) => ({
      value: department.id,
      label: department.name
    }))
  ], [departments]);

  return (
    <form className="filters" onSubmit={onSubmit}>
      <div className="filters-grid">
        <label>
          نام کارمند
          <input
            type="text"
            value={filters.first_name}
            onChange={(event) => onChange('first_name', event.target.value)}
            placeholder="مثلاً محمد"
          />
        </label>
        <label>
          کد پرسنلی
          <input
            type="text"
            value={filters.personnel_code}
            onChange={(event) => onChange('personnel_code', event.target.value)}
            placeholder="۱۲۳۴۵"
          />
        </label>
        <label>
          دپارتمان
          <select
            value={filters.department_id}
            onChange={(event) => onChange('department_id', event.target.value)}
          >
            {departmentOptions.map((option) => (
              <option key={option.value ?? 'all'} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
        </label>
        <label>
          تاریخ استخدام
          <input
            type="date"
            value={filters.hire_date}
            onChange={(event) => onChange('hire_date', event.target.value)}
          />
        </label>
        <label>
          وضعیت همکاری
          <select
            value={filters.employment_status}
            onChange={(event) => onChange('employment_status', event.target.value)}
          >
            {employmentStatusOptions.map((option) => (
              <option key={option.value ?? 'all-status'} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
        </label>
      </div>
      <div className="filters-actions">
        <button type="submit" className="primary-button">
          اعمال فیلتر
        </button>
        <button type="button" className="ghost-button" onClick={onReset}>
          حذف فیلترها
        </button>
      </div>
    </form>
  );
};

export default EmployeeFilters;
