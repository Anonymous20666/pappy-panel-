<main class="flex-1 flex flex-col">
   <div class="flex items-center justify-between p-2 bg-zinc-800 rounded-lg rounded-b-none border border-zinc-700">
      <span class="text-base text-white/50 bg-zinc-900 px-5 rounded-lg">
      Preview
      </span>
      <div class="flex items-center space-x-1 bg-zinc-800 p-1 rounded-lg border border-zinc-700">
         <button id="preview-desktop" class="preview-btn active p-2 rounded-md text-white/50">
            <x-heroicon-m-computer-desktop class="h-4 w-4"/>
         </button>
         <button id="preview-tablet" class="preview-btn p-2 rounded-md text-white/50">
            <x-heroicon-m-device-phone-mobile class="h-4 w-4"/>
         </button>
      </div>
   </div>
   <div class="flex-1 flex items-center justify-center bg-zinc-800 border border-zinc-700 rounded-lg rounded-t-none">
      <div id="preview-container" class="transition-all duration-300 w-full h-full">
         <iframe src="/" class="w-full h-full shadow-2xl bg-white"></iframe>
      </div>
   </div>
</main>