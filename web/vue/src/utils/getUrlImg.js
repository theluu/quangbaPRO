export default function getImgUrl(root,path) {
  return new URL(`${root}/${path}`, import.meta.url).href
}