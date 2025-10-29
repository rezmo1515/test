const ApiStatus = ({ loading, error }) => (
  <section className="api-status" aria-live="polite">
    <div className="container">
      <div className="status-card">
        <h3>وضعیت ارتباط با API منابع انسانی</h3>
        {loading && <p>در حال همگام‌سازی اطلاعات کارکنان با سرور لاراول...</p>}
        {!loading && !error && (
          <p className="status-success">اتصال برقرار است و داده‌های پرسنلی به‌صورت لحظه‌ای به‌روزرسانی می‌شوند.</p>
        )}
        {!loading && error && <p className="status-error">{error}</p>}
        <p className="status-hint">
          برای محیط توسعه، پراکسی Vite درخواست‌ها را به <code>http://localhost:8000/api</code> هدایت می‌کند. در
          محیط عملیاتی می‌توانید دامنه اختصاصی و کلیدهای امنیتی را از طریق متغیرهای محیطی تنظیم کنید.
        </p>
      </div>
    </div>
  </section>
);

export default ApiStatus;
