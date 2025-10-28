import { featureRows } from '../../data/features.js';

const FeaturesTable = () => (
  <section className="features" id="features">
    <div className="container">
      <div className="section-header">
        <h2>چرا مبین هاست انتخاب متخصصان است؟</h2>
        <p>
          خلاصه‌ای از مزایای کلیدی سرویس‌ها بر اساس نیاز مشتریان سازمانی و استارتاپی، برگرفته از کاتالوگ رسمی
          شرکت.
        </p>
      </div>
      <div className="feature-table" role="table">
        <div className="feature-table__head" role="row">
          <div role="columnheader">نوع</div>
          <div role="columnheader">ویژگی‌ها</div>
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
