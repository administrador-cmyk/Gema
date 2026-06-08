# Matriz Cumbre

La Matriz Cumbre es el core de activacion modular del ERP. Su responsabilidad es responder una pregunta por tenant:

```txt
Que modulos existen y cuales tiene habilitados este cliente?
```

## Catalogo global

Path:

```txt
/artifacts/{appId}/public/data/modulos_disponibles/{moduleId}
```

Uso:

- Mostrar catalogo comercial.
- Resolver dependencias entre modulos.
- Mantener precios, categorias, versiones y endpoints tecnicos.

Ejemplo:

```json
{
  "id": "modulo_facturacion_ar",
  "nombre": "Facturacion Electronica ARCA",
  "categoria": "fiscal",
  "dependencias": [],
  "costo_mensual_usd": 15,
  "version": "2.1.0"
}
```

## Activacion privada por tenant

Path:

```txt
/artifacts/{appId}/users/{tenantId}/suscripcion_modulos/config
```

Uso:

- Habilitar o apagar modulos.
- Guardar limites comerciales.
- Guardar configuracion privada por modulo.
- Alimentar el router y el menu dinamico del frontend.

Ejemplo:

```json
{
  "tenantId": "tenant_demo",
  "modulos_activos": {
    "modulo_crm_basic": {
      "habilitado": true,
      "limite_leads": 1000
    },
    "modulo_facturacion_ar": {
      "habilitado": true,
      "config_fiscal": {
        "cuit": "20334445559",
        "punto_venta": 5,
        "condicion_iva": "Responsable Inscripto"
      }
    }
  }
}
```

## Principio de renderizado

El frontend no hardcodea el ERP completo. Renderiza solo el core obligatorio y consulta la Matriz para mostrar modulos opcionales.

El primer ejemplo vive en:

```txt
src/components/AppSidebar.tsx
```

## Decision pendiente

La ruta privada usa `tenantId == auth.uid` para simplificar reglas iniciales. Si un tenant necesita multiples usuarios, el siguiente paso es introducir:

```txt
/artifacts/{appId}/users/{uid}/memberships/{tenantId}
/artifacts/{appId}/tenants/{tenantId}/...
```

Eso permite organizaciones con varios usuarios sin romper el aislamiento multi-tenant.
