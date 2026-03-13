@extends('layouts.admin')

@section('title', 'Add Skill')
@section('page-title', '➕ Add Skill')

@section('content')
<div class="card" style="max-width:500px">
    <div class="card-body">
        <form action="{{ route('admin.skills.store') }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
            @endif
            <div class="form-group">
                <label>Skill Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. PHP, Laravel, MySQL">
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option value="Frontend" {{ old('category') === 'Frontend' ? 'selected' : '' }}>🎨 Frontend</option>
                    <option value="Backend"  {{ old('category') === 'Backend'  ? 'selected' : '' }}>⚙️ Backend</option>
                    <option value="Tools"    {{ old('category') === 'Tools'    ? 'selected' : '' }}>🛠️ Tools</option>
                </select>
            </div>
            <div class="form-group">
                <label>Proficiency Level (1–100) *</label>
                <input type="range" name="level" id="level-range" min="1" max="100" value="{{ old('level', 70) }}" oninput="document.getElementById('level-val').textContent=this.value" style="width:100%;accent-color:var(--accent)">
                <div style="text-align:right;color:var(--accent-light);font-weight:700"><span id="level-val">{{ old('level', 70) }}</span>%</div>
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
            </div>
            <div style="display:flex;gap:1rem;margin-top:1rem">
                <button type="submit" class="btn btn-primary">💾 Save Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
