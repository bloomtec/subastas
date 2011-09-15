package service;

public class ServiceHandler {

	public ServiceHandler() {
	}

	public static void main(String args[]) {
		for (int i = 60; i > 0; i--)
			try {
				Service auditor = new Service();
				auditor.verificarSubastas();
				auditor.start();
				Thread.sleep(983L, 400000);
			} catch (Exception e) {
				e.printStackTrace();
			}

		try {
			Service auditor = new Service();
			auditor.verificarVentas();
			auditor.start();
			Thread.sleep(983L, 400000);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
}