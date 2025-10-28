import { useCallback, useEffect, useMemo, useState } from 'react';
import { fetchDepartments, fetchEmployees } from '../services/api.js';
import EmployeeFilters from '../components/employees/EmployeeFilters.jsx';
import EmployeeTable from '../components/employees/EmployeeTable.jsx';
import EmployeeSummary from '../components/employees/EmployeeSummary.jsx';
import LoadingIndicator from '../components/common/LoadingIndicator.jsx';
import ErrorState from '../components/common/ErrorState.jsx';

const createDefaultFilters = () => ({
  first_name: '',
  personnel_code: '',
  department_id: '',
  hire_date: '',
  employment_status: ''
});

const EmployeesPage = () => {
  const [employees, setEmployees] = useState([]);
  const [departments, setDepartments] = useState([]);
  const [filters, setFilters] = useState(createDefaultFilters);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const loadEmployees = useCallback(async (activeFilters = createDefaultFilters()) => {
    setLoading(true);
    setError('');
    try {
      const cleaned = Object.fromEntries(
        Object.entries(activeFilters).filter(([, value]) => value !== '' && value !== null)
      );
      const data = await fetchEmployees(cleaned);
      setEmployees(Array.isArray(data) ? data : []);
    } catch (err) {
      setError(err.message || 'دریافت اطلاعات کارکنان با خطا مواجه شد');
    } finally {
      setLoading(false);
    }
  }, []);

  const loadDepartments = useCallback(async () => {
    try {
      const data = await fetchDepartments();
      setDepartments(Array.isArray(data) ? data : []);
    } catch (err) {
      // silently ignore dropdown load failures
    }
  }, []);

  useEffect(() => {
    loadDepartments();
    loadEmployees(createDefaultFilters());
  }, [loadDepartments, loadEmployees]);

  const handleFilterChange = (field, value) => {
    setFilters((prev) => ({ ...prev, [field]: value }));
  };

  const handleFilterSubmit = (event) => {
    event.preventDefault();
    loadEmployees(filters);
  };

  const handleReset = () => {
    const defaults = createDefaultFilters();
    setFilters(defaults);
    loadEmployees(defaults);
  };

  const stats = useMemo(() => {
    const total = employees.length;
    const active = employees.filter((item) => item.job?.employment_status === 'active').length;
    const onLeave = employees.filter((item) => item.job?.employment_status === 'leave').length;
    const inactive = employees.filter((item) => item.job?.employment_status === 'inactive').length;

    return {
      total,
      active,
      onLeave,
      inactive
    };
  }, [employees]);

  return (
    <div className="page-section">
      <EmployeeSummary stats={stats} onRefresh={() => loadEmployees(filters)} />
      <section className="card">
        <header className="card-header">
          <div>
            <h2 className="card-title">لیست کارکنان</h2>
            <p className="card-description">مدیریت و مشاهده آخرین وضعیت پرسنل سازمان</p>
          </div>
          <button type="button" className="primary-button">
            افزودن کارمند جدید
          </button>
        </header>
        <EmployeeFilters
          filters={filters}
          departments={departments}
          onChange={handleFilterChange}
          onSubmit={handleFilterSubmit}
          onReset={handleReset}
        />
        {loading ? (
          <LoadingIndicator message="در حال بارگذاری کارکنان..." />
        ) : error ? (
          <ErrorState message={error} onRetry={() => loadEmployees(filters)} />
        ) : (
          <EmployeeTable employees={employees} departments={departments} />
        )}
      </section>
    </div>
  );
};

export default EmployeesPage;
