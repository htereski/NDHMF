export default function formatDate(dateString) {
  if (!dateString) {
    return ''
  }
  const date = new Date(dateString)
  const options = { day: '2-digit', month: 'long', year: 'numeric' }

  return new Intl.DateTimeFormat('pt-BR', options).format(date)
}
