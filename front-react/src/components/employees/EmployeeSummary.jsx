import RefreshIcon from '../svg/RefreshIcon.jsx';

const SummaryCard = ({ title, value, accent }) => (
  <div className={`summary-card summary-${accent}`}>
    <span className="summary-title">{title}</span>
    <strong className="summary-value">{value}</strong>
  </div>
);

const EmployeeSummary = ({ stats = {}, onRefresh }) => {
  const {
    total = 0,
    active = 0,
    onLeave = 0,
    inactive = 0
  } = stats;

  return (
    <section className="summary-grid" aria-label="آمار سریع کارکنان">
      <SummaryCard title="تعداد کل کارکنان" value={total} accent="primary" />
      <SummaryCard title="کارکنان فعال" value={active} accent="success" />
      <SummaryCard title="مرخصی" value={onLeave} accent="warning" />
      <SummaryCard title="غیرفعال" value={inactive} accent="neutral" />
      <button type="button" className="refresh-button" onClick={onRefresh}>
        <RefreshIcon />
        بروزرسانی
      </button>
    </section>
  );
};

export default EmployeeSummary;
