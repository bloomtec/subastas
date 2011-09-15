package service;

import java.io.*;

public class Service extends Thread {

	public Service() {
	}

	public void verificarSubastas() {
		verificarSubastas = true;
	}

	public void verificarVentas() {
		verificarSubastas = false;
	}

	public boolean isVerificarSubastas() {
		return verificarSubastas;
	}

	public boolean isVerificarVentas() {
		return !verificarSubastas;
	}

	public void run() {
		if (isVerificarSubastas()) {
			runSubastas();
		}
		if (isVerificarVentas()) {
			runVentas();
		}

		try {
			this.finalize();
		} catch (Throwable e) {
			e.printStackTrace();
		}
	}

	private void runSubastas() {
		try {
			proceso = Runtime
					.getRuntime()
					.exec("/home/jucedogi/llevatelos.com/cake/console/cake verificar_subastas");
			stdInput = new BufferedReader(new InputStreamReader(
					proceso.getInputStream()));
			stdError = new BufferedReader(new InputStreamReader(
					proceso.getErrorStream()));
			System.out.println("Salida de la ejecucion:\n");
			while ((output = stdInput.readLine()) != null)
				System.out.println(output);
			System.out.println("Salida de errores (si los hay):\n");
			while ((output = stdError.readLine()) != null)
				System.out.println(output);
			stdError.close();
			stdInput.close();
			proceso.destroy();
			return;
		} catch (Exception e) {
			System.out
					.println("Ha ocurrido una excepcion - lo que se sabe es: ");
			e.printStackTrace();
			return;
		}
	}

	private void runVentas() {
		try {
			proceso = Runtime
					.getRuntime()
					.exec("/home/jucedogi/llevatelos.com/cake/console/cake verificar_ventas");
			stdInput = new BufferedReader(new InputStreamReader(
					proceso.getInputStream()));
			stdError = new BufferedReader(new InputStreamReader(
					proceso.getErrorStream()));
			System.out.println("Salida de la ejecucion:\n");
			while ((output = stdInput.readLine()) != null)
				System.out.println(output);
			System.out.println("Salida de errores (si los hay):\n");
			while ((output = stdError.readLine()) != null)
				System.out.println(output);
			stdError.close();
			stdInput.close();
			proceso.destroy();
			return;
		} catch (Exception e) {
			System.out
					.println("Ha ocurrido una excepcion - lo que se sabe es: ");
			e.printStackTrace();
			return;
		}
	}

	private Process proceso;
	private BufferedReader stdInput;
	private BufferedReader stdError;
	private String output;
	private boolean verificarSubastas;
}