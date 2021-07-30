const inp_text_recievedAmount = document.getElementById('inp_recievedAmount')
const p_received = document.getElementById('recieved')
const p_change = document.getElementById('change')
const span_total_amount = document.getElementById('total_amount')

if(span_total_amount.innerText == '0.00'){
    inp_text_recievedAmount.setAttribute('disabled', 'true');
}

inp_text_recievedAmount.addEventListener('keyup', () => {
    if (inp_text_recievedAmount.value != '') {
        p_received.innerText = `PKR ${inp_text_recievedAmount.value}`
        p_change.innerText = 'PKR ' + (inp_text_recievedAmount.value - parseFloat(span_total_amount.innerText))
    }
    else {
        p_received.innerText = `PKR 0.00`
        p_change.innerText = 'PKR 0.00'
    }
})


//TODO Get the object with class active.

//TODO check how to navigate inside the active element