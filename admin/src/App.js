import { HydraAdmin, fetchHydra, hydraDataProvider } from "@api-platform/admin";
import { parseHydraDocumentation } from "@api-platform/api-doc-parser";
import authProvider from "./authProvider"

const entrypoint = "https://127.0.0.1:8000/api";

const dataProvider = hydraDataProvider({
  entrypoint,
  httpClient: fetchHydra,
  apiDocumentationParser: parseHydraDocumentation,
  mercure: { hub: "https://mercure.rocks/hub" },
});

export default () => (
    <HydraAdmin
        authProvider={authProvider}
        dataProvider={dataProvider}
        entrypoint={entrypoint}
    />
);
