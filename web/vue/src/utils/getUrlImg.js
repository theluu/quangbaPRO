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

  // import.meta.url is always relative to this file (src/utils/).
  // Strip any leading "../" segments and optional "src/" prefix from root,
  // then resolve correctly from src/utils/ → ../assets/...
  const normalizedRoot = root.replace(/^(\.\.\/)*(?:src\/)?/, '')
  return new URL(`../${normalizedRoot}/${path}`, import.meta.url).href
}
