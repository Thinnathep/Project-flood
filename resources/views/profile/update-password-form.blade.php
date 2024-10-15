<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('อัปเดตพาสเวิร์ด') }}
    </x-slot>

    <x-slot name="description">
        {{ __('ให้แน่ใจว่าบัญชีของคุณใช้รหัสผ่านที่ยาวและสุ่มเพื่อความปลอดภัย') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('รหัสผ่านปัจจุบัน') }}" />
            <x-input id="current_password" type="password"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300"
                wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('รหัสผ่านใหม่') }}" />
            <x-input id="password" type="password"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300"
                wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('ยืนยันรหัสผ่าน') }}" />
            <x-input id="password_confirmation" type="password"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-300"
                wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('บันทึกเรียบร้อยแล้ว') }}
        </x-action-message>

        <x-button
            class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md shadow-md transition ease-in-out duration-150">
            {{ __('บันทึก') }}
        </x-button>
    </x-slot>
</x-form-section>
