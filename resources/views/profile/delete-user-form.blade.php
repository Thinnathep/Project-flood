<x-action-section>
    <x-slot name="title">
        {{ __('ลบบัญชี') }}
    </x-slot>

    <x-slot name="description">
        {{ __('ลบบัญชีของคุณอย่างถาวร') }}
    </x-slot>

    <x-slot name="content">
        <div class="mb-5">
            <p class="text-gray-600">
                {{ __('เมื่อคุณลบบัญชีของคุณแล้ว ข้อมูลและทรัพยากรทั้งหมดจะถูกลบอย่างถาวร กรุณาให้แน่ใจ') }}
            </p>
        </div>

        <div class="flex items-center">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('ลบบัญชี') }}
            </x-danger-button>
            <x-action-message class="ms-3" on="accountDeleted">
                {{ __('เสร็จสิ้น') }}
            </x-action-message>
        </div>

        <x-confirmation-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('ลบบัญชี') }}
            </x-slot>

            <x-slot name="content">
                {{ __('คุณแน่ใจหรือไม่ว่าต้องการลบบัญชีของคุณ? เมื่อคุณลบบัญชี ข้อมูลและทรัพยากรทั้งหมดจะถูกลบอย่างถาวร กรุณาให้แน่ใจ') }}
                <div class="mt-4">
                    <x-input type="password" class="mt-1 block w-1/2" placeholder="{{ __('รหัสผ่าน') }}"
                        wire:model.defer="password" wire:keydown.enter="deleteUser" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingUserDeletion', false)">
                    {{ __('ยกเลิก') }}
                </x-secondary-button>

                <x-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('ลบบัญชี') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    </x-slot>
</x-action-section>
