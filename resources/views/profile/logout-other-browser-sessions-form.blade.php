<x-action-section>
    <x-slot name="title">
        {{ __('การจัดการเซสชันเบราว์เซอร์') }}
    </x-slot>

    <x-slot name="description">
        {{ __('จัดการและออกจากเซสชันที่เปิดใช้งานบนอุปกรณ์อื่น') }}
    </x-slot>

    <x-slot name="content">
        <p class="max-w-xl text-sm text-gray-600">
            {{ __('คุณสามารถออกจากเซสชันเบราว์เซอร์อื่นทั้งหมดในทุกอุปกรณ์ ด้านล่างนี้คือเซสชันล่าสุดบางส่วนของคุณ แต่รายการนี้อาจไม่ครบถ้วน หากคุณเชื่อว่าบัญชีของคุณถูกบุกรุก กรุณาเปลี่ยนรหัสผ่าน') }}
        </p>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-4">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center bg-gray-50 p-3 rounded-lg shadow">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>
                        <div class="ms-3">
                            <div class="text-sm text-gray-600">
                                {{ $session->agent->platform() ?? __('ไม่ทราบ') }} - {{ $session->agent->browser() ?? __('ไม่ทราบ') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $session->ip_address }},
                                @if ($session->is_current_device)
                                    <span class="text-green-500 font-semibold">{{ __('อุปกรณ์นี้') }}</span>
                                @else
                                    {{ __('เมื่อเร็วๆ นี้') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('ออกจากเซสชันที่เปิดอยู่ทั้งหมด') }}
            </x-button>
        </div>
    </x-slot>
</x-action-section>
