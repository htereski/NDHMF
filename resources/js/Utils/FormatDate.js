export default function formatDate(dateString, type = 'long') {
  if (!dateString) {
    return ''
  }
  const date = new Date(dateString)

  let options = {}

  switch (type) {
    case 'hour':
      options = {
        hour: '2-digit',
        minute: '2-digit',
      }
      break

    case 'day':
      options = {
        year: 'numeric',
        day: 'numeric',
        month: 'numeric',
      }
      break

    default:
      options = {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
      }
      break
  }

  return new Intl.DateTimeFormat('pt-BR', options).format(date)
}
