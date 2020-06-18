<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{

	public function show()
	{
		return view('contact');
	}

	public function send()
	{
		$message = request()->validate([
			'name' => 'required',
			'email' => 'required|email',
			'asunt' => 'required',
			'message' => 'required|min:5'
		]);

		Mail::to('jose.tanta.27@unsch.edu.pe')
				->queue(new MessageReceived($message));
		// return new MessageReceived($message);
		return "Formulario Correcto Y Mensaje Enviado";
	}


}