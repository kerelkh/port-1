<div class="flex justify-between items-center">
    <p class="text text-gray-700">{{ now()->format('F') . '/' . now()->format('Y') }}</p>
    <p class="md:text-lg lg:text-xl font-medium tracking-wider" id="live-clock">00 : 00 : 00</p>
</div>
<div class="grid grid-cols-7 gap-2 mt-5">
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-gray-400">{{ now()->subDays(3)->format('D') }}</p>
        <p class="text-gray-600">{{ now()->subDays(3)->format('d') }}</p>
    </div>
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-gray-400">{{ now()->subDays(2)->format('D') }}</p>
        <p class="text-gray-700">{{ now()->subDays(2)->format('d') }}</p>
    </div>
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-gray-400">{{ now()->subDays(1)->format('D') }}</p>
        <p>{{ now()->subDays(1)->format('d') }}</p>
    </div>
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-blue-700">{{ now()->format('D') }}</p>
        <p class="text-blue-700">{{ now()->format('d') }}</p>
    </div>
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-gray-400">{{ now()->addDays(1)->format('D') }}</p>
        <p>{{ now()->addDays(1)->format('d') }}</p>
    </div>
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-gray-400">{{ now()->addDays(2)->format('D') }}</p>
        <p class="text-gray-700">{{ now()->addDays(2)->format('d') }}</p>
    </div>
    <div class="cols-span-1 flex flex-col gap-2 text-center">
        <p class="text-gray-400">{{ now()->addDays(3)->format('D') }}</p>
        <p class="text-gray-600">{{ now()->addDays(3)->format('d') }}</p>
    </div>
</div>

<script>
    let liveTime = setInterval(() => {
                let today = new Date();
                let hours = today.getHours();
                let time = 'AM';
                if(today.getHours() > 12){
                    hours = today.getHours() - 12;
                    time = 'PM'
                }
                let date = hours+':'+today.getMinutes()+':'+today.getSeconds() + ' '+time;
                $('#live-clock').html(date);
            }, 1000);
</script>
