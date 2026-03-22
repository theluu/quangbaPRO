export function getCircularProgressBarInstance(className) {
  if (typeof window !== 'undefined' && window.CircularProgressBar) {
    return new window.CircularProgressBar(className);
  }
  console.error('CircularProgressBar không khả dụng.');
  return null;
}