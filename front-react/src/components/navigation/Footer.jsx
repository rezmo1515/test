const Footer = () => (
  <footer className="site-footer" id="contact">
    <div className="container footer-container">
      <div>
        <h3>مبین HR</h3>
        <p>پلتفرم بومی مدیریت سرمایه انسانی برای سازمان‌های در حال رشد و شرکت‌های بزرگ.</p>
      </div>
      <div>
        <h4>راه‌های ارتباطی</h4>
        <ul>
          <li>تلفن: ۰۲۱-۱۲۳۴۵۶۷</li>
          <li>پشتیبانی اختصاصی HR از طریق تیکت و چت سازمانی</li>
          <li>ایمیل: support@mobinhr.example</li>
        </ul>
      </div>
      <div>
        <h4>آدرس</h4>
        <p>تهران، خیابان مثال، پلاک ۴۲، واحد ۱۰</p>
      </div>
    </div>
    <div className="footer-bottom">© {new Date().getFullYear()} مبین HR. تمامی حقوق محفوظ است.</div>
  </footer>
);

export default Footer;
