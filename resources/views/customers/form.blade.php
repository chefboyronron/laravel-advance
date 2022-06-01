<div class="form-group">
    <label for="name">Name</label>
    <input type="text" value="{{ old('name') ?? $customer->name }}" name="name" id="name" class="form-control">
    {{ $errors->first('name') }}
</div>
<div class="form-group">
    <label for="name">Email</label>
    <input type="text" value="{{ old('email') ?? $customer->email }}" name="email" id="email" class="form-control">
    {{ $errors->first('email') }}
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control">
        <option value="">-- please select status --</option>
        @foreach($customer->statusOptions() as $key => $option)
            <option value="{{ $key }}" {{ $customer->status == $option ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
    {{ $errors->first('status') }}
</div>
<div class="form-group">
    <label for="company_id">Company</label>
    <select name="company_id" id="company_id" class="form-control">
        <option value="">-- please select company --</option>
        @foreach( $companies as $company ) 
            <option value="{{ $company->id }}" {{ $company->id == $customer->company_id ? 'selected' : '' }} >{{ $company->name }}</option>
        @endforeach
    </select>
    {{ $errors->first('company_id') }}
</div>
<div class="form-group">
    <label for="image" class="d-flex flex-column">Profile Image</label>
    @if( $customer->image )
        <img src="{{ asset('storage/' . $customer->image) }}" alt="{{ $customer->name }}" class="img-fluid">
    @endif
    <input type="file" name="image" class="py-2">
    {{ $errors->first('image') }}
</div>
@csrf