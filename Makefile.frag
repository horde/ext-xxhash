# Makefile fragment for horde_xxhash extension
# This gets included in the generated Makefile

# Sync version from .horde.yml before build
$(all_targets): sync-version

.PHONY: sync-version
sync-version:
	@if [ -f scripts/sync-version.sh ]; then \
		bash scripts/sync-version.sh; \
	fi
