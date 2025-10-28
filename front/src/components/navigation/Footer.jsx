const Footer = () => (
  <footer className="site-footer" id="contact">
    <div className="container footer-container">
      <div>
        <h3>مبین هاست</h3>
        <p>با بیش از ده سال تجربه در ارائه سرویس‌های میزبانی ابری، سرور و ثبت دامنه.</p>
      </div>
      <div>
        <h4>راه‌های ارتباطی</h4>
        <ul>
          <li>تلفن: ۰۲۱-۱۲۳۴۵۶۷</li>
          <li>پشتیبانی ۲۴ ساعته از طریق تیکت</li>
          <li>ایمیل: support@mobinhost.example</li>
        </ul>
      </div>
      <div>
        <h4>آدرس</h4>
        <p>تهران، خیابان مثال، پلاک ۴۲، واحد ۱۰</p>
      </div>
    </div>
    <div className="footer-bottom">© {new Date().getFullYear()} مبین هاست. تمامی حقوق محفوظ است.</div>
  </footer>
);

export default Footer;
