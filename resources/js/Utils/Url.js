import { usePage } from '@inertiajs/vue3'

const page = usePage()

export function getBaseUrl() {
  if (page.props.app_url.includes('localhost')) {
    return `${page.props.app_url}:8000/`
  }
  return page.props.app_url
}

export function buildFullUrl(route) {
  const url = window.location.href

  let app_url = getBaseUrl()

  if (url !== app_url) {
    return `${app_url}${route}`
  }
  return route
}
