export const formatPersianDateTime = (value) => {
  try {
    const formatter = new Intl.DateTimeFormat('fa-IR-u-ca-persian', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      weekday: 'long',
      hour: '2-digit',
      minute: '2-digit'
    });
    return formatter.format(value);
  } catch (error) {
    return new Intl.DateTimeFormat('fa-IR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    }).format(value);
  }
};

export const formatPersianDate = (value) => {
  if (!value) return 'نامشخص';
  try {
    const date = value instanceof Date ? value : new Date(value);
    return new Intl.DateTimeFormat('fa-IR-u-ca-persian', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    }).format(date);
  } catch (error) {
    const date = value instanceof Date ? value : new Date(value);
    return new Intl.DateTimeFormat('fa-IR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    }).format(date);
  }
};
