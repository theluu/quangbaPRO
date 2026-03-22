// Mô-đun này định nghĩa các hàm để gọi API cho ứng dụng xác minh OTP
// Sử dụng axios để thực hiện các yêu cầu HTTP
import axios from 'axios';

// Sử dụng biến môi trường hoặc fallback về localhost:3000
const BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:3000';

// Tạo instance của Axios với base URL
const api = axios.create({
  baseURL: BASE_URL,
  timeout: 5000,
});

export const updateProfile = async (data) => {
  return await api.put('/api/user/profile', data);
};

export const uploadAvatar = async (formData) => {
  return await api.post('/api/user/avatar', formData, {
    headers: { 'Content-Type': 'multipart/form-data' },
  });
};

export const updateEmail = async (data) => {
  console.log('updateEmail:', data);
  return await api.put('/api/user/email', data);
};

export const updatePhone = async (data) => {
  console.log('updatePhone:', data);
  return await api.put('/api/user/phone', data);
};

export const changePassword = async (data) => {
  return await api.put('/api/user/password', data);
};

export const sendOtp = async (data) => {
  return await api.post('/api/otp/send', data);
};

export const verifyOtp = async (data) => {
  return await api.post('/api/otp/verify', data);
};

// Hàm kiểm tra email tồn tại
export const checkEmail = async (email) => {
  return await api.post('/api/check-email', { email });
};

export const checkPhone = async (phone, dialCode) => {
  return await api.post('/api/check-phone', { phone, dialCode });
};

// Hàm gọi API xác minh OTP
export const verifyOtpApi = async (otp, phone) => {
  // Gửi yêu cầu POST tới JSON Server
  const response = await api.post('/verify-otp', { otp, phone });
  console.log(`API called: POST ${BASE_URL}/verify-otp with OTP: ${otp}, Phone: ${phone}`);
  return response;
};