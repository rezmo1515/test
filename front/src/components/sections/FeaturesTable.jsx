import { fallbackFeatureRows } from '../../data/features.js';

const FeaturesTable = () => (
  <section className="features" id="features">
    <div className="container">
      <div className="section-header">
        <h2>ماژول‌های کلیدی سامانه منابع انسانی</h2>
        <p>
          مجموعه‌ای کامل از قابلیت‌های ضروری برای مدیریت چرخه عمر کارکنان، از ثبت اطلاعات اولیه تا تحلیل‌های
          راهبردی و انطباق حقوقی.
        </p>
      </div>
      <div className="feature-table" role="table">
        <div className="feature-table__head" role="row">
          <div role="columnheader">دسته‌بندی</div>
          <div role="columnheader">قابلیت‌ها</div>
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
