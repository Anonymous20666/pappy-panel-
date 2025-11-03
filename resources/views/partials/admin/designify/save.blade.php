        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[612px] rounded-xl sm:border border-zinc-700 bg-zinc-950/60 pt-2 mt-6 px-4 mb-2 backdrop-blur-xl">
            <div class="flex items-center justify-between pb-2">
                <div class="hidden sm:block text-sm text-zinc-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    Changes will be applied immediately after saving
                </div>
                <div class="flex items-center space-x-3">
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="PATCH"
                        class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-zinc-900 flex items-center space-x-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span class="hidden sm:block">Save changes</span>
                    </button>
                </div>
            </div>
        </div>