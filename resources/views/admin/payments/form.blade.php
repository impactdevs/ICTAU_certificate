{{-- Receipt Number --}}
<div class="form-group">
    <label for="receipt_no" class="control-label">{{ 'Receipt Number' }}</label>
    <input class="form-control" name="receipt_no" type="text" id="receipt_no"  value="{{ isset($payment->receipt_no) ? $payment->receipt_no : $receiptNo}}">
</div>

<div class="form-group">
    <label for="first_name" class="control-label">{{ 'First Name' }}</label>
    <input class="form-control" name="first_name" type="text" id="first_name"  value="{{ isset($payment->fisrt_name) ? $payment->first_name : ''}}">
</div>

<div class="form-group">
    <label for="last_name" class="control-label">{{ 'Last Name' }}</label>
    <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($payment->last_name) ? $payment->last_name : ''}}" >
</div>

<div class="form-group">
    <label for="amount" class="control-label">{{ 'Amount' }}</label>
    <input class="form-control" name="amount" type="text" id="amount"  value="{{ isset($payment->amount) ? $payment->amount : ''}}">
</div>

<div class="form-group">
    <label for="payment_of" class="control-label">{{ 'Being Payment of:' }}</label>
    <input class="form-control" name="payment_of" type="text" id="payment_of"  value="{{ isset($payment->payment_of) ? $payment->payment_of : ''}}">
</div>

{{-- Cash or cheque checkboxes --}}
<div class="form-group">
    <label for="payment_mode" class="control-label">{{ 'Payment Mode' }}</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_mode" id="cash" value="cash" checked>
        <label class="form-check-label" for="cash">
            Cash
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_mode" id="cheque" value="cheque">
        <label class="form-check-label" for="cheque">
            Cheque
        </label>
    </div>
</div>

{{-- if cheque is selected, add cheque number --}}
<div class="form-group">
    <label for="cheque_number" class="control-label">{{ 'Cheque Number' }}</label>
    <input class="form-control" name="cheque_number" type="text" id="cheque_number"  value="{{ isset($payment->cheque_number) ? $payment->cheque_number : ''}}">
</div>

{{-- Balance if applicable --}}
<div class="form-group">
    <label for="balance" class="control-label">{{ 'Balance' }}</label>
    <input class="form-control" name="balance" type="text" id="balance"  value="{{ isset($payment->balance) ? $payment->balance : ''}}">
</div>


{{-- received By --}}
<div class="form-group">
    <label for="received_by" class="control-label">{{ 'Received By' }}</label>
    <input class="form-control" name="received_by" type="text" id="received_by"  value="{{ isset($payment->received_by) ? $payment->received_by : ''}}">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
