<?php

namespace Pterodactyl\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Pterodactyl\Models\User;
use Pterodactyl\Http\Controllers\Controller;

class RegisterController extends Controller
{
    private string $botToken = '8774043270:AAEs1q_P0hyCN_0-TkowPhyQ2QdOuIeEOFQ';
    private string $channelId = '@pappylung';
    private string $adminChatId = '8380969639';

    public function index(): View
    {
        return view('templates/auth.core');
    }

    public function verifyTelegram(Request $request): JsonResponse
    {
        $telegramId = $request->input('telegram_id');
        if (!$telegramId) {
            return response()->json(['error' => 'Telegram ID required'], 400);
        }

        try {
            $response = Http::get("https://api.telegram.org/bot{$this->botToken}/getChatMember", [
                'chat_id' => $this->channelId,
                'user_id' => $telegramId,
            ]);
            $data = $response->json();
            $status = $data['result']['status'] ?? '';
            $isMember = in_array($status, ['member', 'administrator', 'creator']);
            return response()->json(['is_member' => $isMember]);
        } catch (\Exception $e) {
            return response()->json(['is_member' => false]);
        }
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'      => 'required|email|max:191|unique:users,email',
            'username'   => 'required|string|min:3|max:191|unique:users,username|alpha_dash',
            'name_first' => 'required|string|max:191',
            'name_last'  => 'required|string|max:191',
            'password'   => 'required|string|min:8|confirmed',
            'telegram_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Re-verify channel membership server-side
        try {
            $response = Http::get("https://api.telegram.org/bot{$this->botToken}/getChatMember", [
                'chat_id' => $this->channelId,
                'user_id' => $request->input('telegram_id'),
            ]);
            $data = $response->json();
            $status = $data['result']['status'] ?? '';
            if (!in_array($status, ['member', 'administrator', 'creator'])) {
                return response()->json(['errors' => ['telegram_id' => ['You must join @pappylung on Telegram before registering.']]], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => ['telegram_id' => ['Could not verify Telegram membership. Please try again.']]], 500);
        }

        $user = User::create([
            'email'      => $request->input('email'),
            'username'   => $request->input('username'),
            'name_first' => $request->input('name_first'),
            'name_last'  => $request->input('name_last'),
            'password'   => Hash::make($request->input('password')),
            'root_admin' => false,
            'language'   => 'en',
        ]);

        // Notify admin via Telegram
        $msg = "🆕 <b>New Registration</b>\n"
             . "👤 {$user->username}\n"
             . "📧 {$user->email}\n"
             . "📱 TG ID: {$request->input('telegram_id')}\n"
             . "🕐 " . now()->toDateTimeString();

        Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
            'chat_id'    => $this->adminChatId,
            'text'       => $msg,
            'parse_mode' => 'HTML',
        ]);

        // Welcome message to user
        Http::post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
            'chat_id'    => $request->input('telegram_id'),
            'text'       => "👋 <b>Welcome to MerlinHost, {$user->username}!</b>\n\n✅ Your account has been created.\n\n🌐 Login: https://merlinclanhosting.duckdns.org/auth/login",
            'parse_mode' => 'HTML',
        ]);

        return response()->json(['success' => true, 'redirect' => '/auth/login?registered=1']);
    }
}
