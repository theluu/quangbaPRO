export default function getImgUrl(root, path) {
  if (!path) {
    return ''
  }

  if (
    path.startsWith('http://') ||
    path.startsWith('https://') ||
    path.startsWith('//') ||
    path.startsWith('/')
  ) {
    return path
  }

  return new URL(`${root}/${path}`, import.meta.url).href
}
