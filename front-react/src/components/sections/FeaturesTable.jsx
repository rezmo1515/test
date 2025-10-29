import { featureRows } from '../../data/features.js';

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
        {featureRows.map((row) => (
          <div key={row.type} className="feature-table__row" role="row">
            <div role="cell" className="feature-table__type">
              {row.type}
            </div>
            <div role="cell" className="feature-table__details">
              <ul>
                {row.details.map((detail) => (
                  <li key={detail}>{detail}</li>
                ))}
              </ul>
            </div>
          </div>
        ))}
      </div>
    </div>
  </section>
);

export default FeaturesTable;
