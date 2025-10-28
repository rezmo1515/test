const ApiStatus = ({ loading, error }) => (
  <section className="api-status" aria-live="polite">
    <div className="container">
      <div className="status-card">
        <h3>وضعیت اتصال به API لاراول</h3>
        {loading && <p>در حال برقراری ارتباط با سرور...</p>}
        {!loading && !error && (
          <p className="status-success">اتصال با موفقیت برقرار شد و اطلاعات سرویس‌ها به‌روز است.</p>
        )}
        {!loading && error && <p className="status-error">{error}</p>}
        <p className="status-hint">
          برای استفاده در محیط توسعه، پروکسی Vite درخواست‌ها را به آدرس <code>http://localhost:8000/api</code>
          هدایت می‌کند. در سرور اصلی می‌توانید آدرس پایه را از طریق متغیرهای محیطی تنظیم کنید.
        </p>
      </div>
    </div>
  </section>
);

export default ApiStatus;
