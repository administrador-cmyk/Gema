# Centro de Estabilidad y Seguridad Cumbre

Estado: MVP técnico inicial.

## Objetivo

Anticipar caídas, saturación, problemas de seguridad, costos y degradación de APIs antes de que afecten clientes. El sistema debe operar como un radar preventivo con agente IA, notificaciones y remediación controlada.

## Capas

1. Panel Cumbre: visualiza estado, checks, eventos, recomendaciones, notificaciones y remediaciones.
2. Health Collector: ejecuta checks de red, Firebase y targets reservados para servidor.
3. Motor de reglas: convierte métricas en severidad, riesgo y acción recomendada.
4. Señales de seguridad: fuerza bruta, abuso de API, fallos de auth y reglas inseguras.
5. Agente IA: explica el problema en lenguaje operativo y propone próximos pasos.
6. Notificaciones: panel activo; email/WhatsApp listos para conectar.
7. Autorremediación: allowlist segura con aprobación humana para acciones sensibles.

## Checks iniciales

- Home pública `https://gema-digital.com/`.
- Centro legal Cumbre.
- Landing ERP Cumbre.
- Landing Cumbre CRM.
- API agente IA `/health`.
- Firestore lectura.
- Firestore escritura controlada.
- SSL, disco, memoria, seguridad y costos como targets de agente servidor.

## Acciones automáticas permitidas

- Limpiar cache WordPress/LiteSpeed.
- Pausar jobs no críticos.
- Activar modo degradado.
- Crear ticket interno.

## Acciones con aprobación humana

- Reiniciar servicios.
- Cambiar infraestructura.
- Bloquear IPs.
- Desactivar integraciones.
- Cambiar reglas de seguridad.
- Borrar datos.
- Tocar ARCA, DNS, SSL, backups o despliegues.

## Próxima fase

Mover el recolector a Cloud Functions o Cloud Run programado para acceder a:

- Google Cloud Monitoring.
- Logs de OpenLiteSpeed/LiteSpeed.
- Logs de WordPress y wp-login.
- Métricas de disco, CPU y memoria.
- Costos y cuotas Firebase/GCP.
- Estado real de SSL.
- Webhooks de alertas por WhatsApp y email.
