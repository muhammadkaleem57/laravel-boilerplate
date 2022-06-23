const Swal = window.Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.addEventListener('toaster:success', (event) => {
    Toast.fire({
        icon: 'success',
        title: event.detail ?? 'No message'
    })
})

window.addEventListener('toaster:error', (event) => {
    Toast.fire({
        icon: 'error',
        title: event.detail ?? 'No message'
    })
})

window.addEventListener('toaster:warning', (event) => {
    Toast.fire({
        icon: 'warning',
        title: event.detail ?? 'No message'
    })
})

window.addEventListener('toaster:info', (event) => {
    Toast.fire({
        icon: 'info',
        title: event.detail ?? 'No message'
    })
})