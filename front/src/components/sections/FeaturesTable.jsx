import { fallbackFeatureRows } from '../../data/features.js';

const FeaturesTable = ({ rows = [], loading = false, error = '' }) => {
  const featureRows = rows.length ? rows : fallbackFeatureRows;

  return (
    <section className="features" id="features">
      <div className="container">
        <div className="section-header">
          <h2>ماژول‌های کلیدی کنترل و گزارش منابع انسانی</h2>
          <p>در یک نگاه، امکاناتی که پرونده‌های پرسنلی، دسترسی‌ها و گزارش‌های مالی را پوشش می‌دهد.</p>
        </div>
        {error && <div className="alert alert-error">{error}</div>}
        <div className="feature-table" role="table" aria-busy={loading}>
          <div className="feature-table__head" role="row">
            <div role="columnheader">ماژول</div>
            <div role="columnheader">شرح امکانات</div>
          </div>
          {loading ? (
            <div className="feature-table__loader" role="row">
              <div role="cell" className="feature-table__type skeleton" />
              <div role="cell" className="feature-table__details skeleton" />
            </div>
          ) : (
            featureRows.map((row) => (
              <div key={row.module} className="feature-table__row" role="row">
                <div role="cell" className="feature-table__type">
                  {row.module}
                </div>
                <div role="cell" className="feature-table__details">
                  <ul>
                    {row.items.map((item) => (
                      <li key={item.title}>
                        <strong>{item.title}</strong>
                        <span>{item.description}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              </div>
            ))
          )}
        </div>
      </div>
    </section>
  );
};

export default FeaturesTable;
